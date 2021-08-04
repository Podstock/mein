import axios from "axios";

let pc; /* PeerConnection */

function pc_offer() {
    const offerOptions = {
        iceRestart: false,
    };
    pc.createOffer(offerOptions)
        .then(function (desc) {
            console.log("got local description: %s", desc.type);

            pc.setLocalDescription(desc).then(
                () => {},
                function (error) {
                    console.log("setLocalDescription: %s", error.toString());
                }
            );
        })
        .catch(function (error) {
            console.log(
                "Failed to create session description: %s",
                error.toString()
            );
        });
}

export default {
    isListening: false,
    stream: null,
    audio_input_id: null,
    audio_output_id: null,
    audio_inputs: [],
    audio_outputs: undefined,
    room_slug: undefined,
    echo: false,

    mediaConstraints: {
        audio: {
            echoCancellation: false, // disabling audio processing
            autoGainControl: false,
            noiseSuppression: false,
            channelCount: 1, //Firefox needs this for mono downsampling
            latency: 0.02, //20ms
            deviceId: undefined,
            sampleRate: 48000,
        },
        video: false,
    },

    init() {
        console.log("webrtc:init");
        Echo.private("webrtc.sdp." + window.user_id).listen(
            "WebrtcSDP",
            (e) => {
                this.sdp(e);
            }
        );
    },

    echo_connect() {
        this.room_slug = 'echo';
        // this.room_slug = window.room_slug;
        this.start();
        this.echo = true;
    },

    room_connect() {
        this.room_slug = window.room_slug;
        this.start();
    },

    async setup() {
        console.log("webrtc:setup");

        try {
            this.stream = await navigator.mediaDevices.getUserMedia(
                this.mediaConstraints
            );
        } catch (e) {
            console.log("webrtc: microphone permission denied...");
        }

        let deviceInfos = await navigator.mediaDevices.enumerateDevices();
        this.gotDevices(deviceInfos);

        this.audio_input_id = this.stream
            .getAudioTracks()[0]
            .getSettings().deviceId;

        if ("wakeLock" in navigator) {
            navigator.wakeLock.request("screen").then((wakeLock) => {
                console.log("webrtc: Wake Lock active.");
            });
        }
    },

    async audio_input_changed() {
        console.log("webrtc: try audio %s", this.audio_input_id);
        this.mediaConstraints.audio.deviceId = { exact: this.audio_input_id };
        this.stream.getAudioTracks()[0].stop();

        try {
            let new_stream = await navigator.mediaDevices.getUserMedia(
                this.mediaConstraints
            );

            this.stream = new_stream;
            let track = this.stream.getAudioTracks()[0];

            console.log("webrtc: changed audo: " + track.getSettings().deviceId);

            if (pc) {
                let sender = pc.getSenders().find(function (s) {
                    return s.track.kind == track.kind;
                });

                sender.replaceTrack(track);
            }
        } catch (e) {
            console.log("webrtc: microphone permission denied...");
        }
    },

    audio_output_changed() {
        if (typeof this.audio_output_id === "undefined") return;
        let audio = document.querySelector("audio#audio");

        if (
            typeof audio === "undefined" ||
            typeof audio.setSinkId === "undefined"
        ) {
            console.log(
                "webrtc: audio element not found or setSinkId not supported"
            );
            return;
        }

        audio.setSinkId(this.audio_output_id);
    },

    gotDevices(deviceInfos) {
        for (let i = 0; i !== deviceInfos.length; ++i) {
            const deviceInfo = deviceInfos[i];

            if (deviceInfo.kind === "audioinput") {
                let text = deviceInfo.label || `microphone ${i}`;
                let value = { key: deviceInfo.deviceId, value: text };
                this.audio_inputs.push(value);
                console.log("webrtc: audio_input", value.key, value.value);
            } else if (deviceInfo.kind === "audiooutput") {
                if (typeof this.audio_outputs === "undefined") {
                    this.audio_outputs = [];
                    this.audio_output_id = "default";
                }
                let text = deviceInfo.label || `speaker ${i}`;
                let value = { key: deviceInfo.deviceId, value: text };
                this.audio_outputs.push(value);
                console.log("webrtc: audio_output", value.key, value.value);
            }
        }
    },

    hangup() {
        axios.get("/webrtc/" + this.room_slug + "/disconnect").then(() => {
            this.isListening = false;
        });

        pc.close();
        pc = null;
    },

    restart() {
        this.hangup();
        this.start();
    },

    start() {
        console.log("webrtc:start");
        this.isListening = true;
        const configuration = {
            bundlePolicy: "balanced",

            iceCandidatePoolSize: 0,
            iceTransportPolicy: "relay",
            // iceTransportPolicy: "all",
            iceServers: [
                {
                    urls: "turn:195.201.63.86:3478",
                    username: "turn200301",
                    credential: "choh4zeem3foh1",
                },
            ],
        };

        pc = new RTCPeerConnection(configuration);

        pc.onicecandidate = (event) => {
            if (event.candidate === null) {
                const sd = pc.localDescription;
                const json = JSON.stringify(sd);

                axios.post("/webrtc/" + this.room_slug + "/sdp", json);
            }
        };

        pc.onicecandidateerror = function (event) {
            // disconnect_call();
            // axios.get("/webrtc/disconnect");

            console.log(
                "ICE Candidate Error: " +
                    event.errorCode +
                    " " +
                    event.errorText
            );
            // console.log(event);
        };

        pc.ontrack = function (event) {
            const track = event.track;
            let audio = document.querySelector("audio#audio");
            console.log("got remote track: kind=%s", track.kind);

            if (audio.srcObject !== event.streams[0]) {
                audio.srcObject = event.streams[0];
                console.log("received remote audio stream");
            }

            // if (remoteVideo.srcObject !== event.streams[0]) {
            //     remoteVideo.srcObject = event.streams[0];
            //     console.log("received remote video stream");
            // }
        };

        this.stream
            .getTracks()
            .forEach((track) => pc.addTrack(track, this.stream));

        pc_offer();
    },

    sdp(json) {
        const descr = json.sdp;

        console.log("remote description: type=%s", descr.type);

        pc.setRemoteDescription(descr).then(
            () => {
                console.log("set remote description -- success");
            },
            function (error) {
                console.log("setRemoteDescription: %s", error.toString());
            }
        );
    },

    toggle_listen() {
        if (this.isListening) {
            axios.get("/webrtc/" + this.room_slug + "/disconnect").then(() => {
                this.isListening = false;
            });
            return;
        }

        this.start();
        //this.isListening = true;
    },
};
