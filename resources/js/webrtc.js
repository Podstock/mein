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
    webrtc: false,
    stream: null,
    audio_input_id: null,
    audio_output_id: null,
    audio_inputs: [],
    audio_outputs: undefined,
    room_slug: undefined,
    echo: false,
    echo_failed: false,
    muted: true,

    mediaConstraints_default: {
        audio: {
            echoCancellation: false, // disabling audio processing
            autoGainControl: false,
            noiseSuppression: false,
            latency: 0.02, //20ms
            sampleRate: 48000,
        },
        video: false,
    },
    mediaConstraints: self.mediaConstraints_default,

    init() {
        console.log("webrtc:init");
        Echo.private("webrtc.sdp." + window.user_id).listen(
            "WebrtcSDP",
            (e) => {
                this.sdp(e);
            }
        );
    },

    mute() {
        this.muted = true;
        this.stream.getAudioTracks().forEach((track) => {
            track.enabled = false;
        });
    },

    unmute() {
        this.muted = false;
        this.stream.getAudioTracks().forEach((track) => {
            track.enabled = true;
        });
    },

    echo_connect() {
        this.room_slug = "echo";
        this.unmute();
        this.hangup();
        this.start();
        this.echo = true;
        this.echo_failed = false;
    },

    echo_success() {
        this.hangup();
        this.mute();
        this.room_connect();
        this.echo = false;
        this.echo_failed = false;
    },

    echo_fail() {
        this.hangup();
        this.echo = false;
        this.echo_failed = true;
    },

    room_connect() {
        this.echo = false;
        this.echo_failed = false;
	this.webrtc = true;
        this.room_slug = window.room_slug;
        this.start();
    },

    async setup() {
        console.log("webrtc:setup");

	this.stop();

        try {
            this.stream = await navigator.mediaDevices.getUserMedia(
                this.mediaConstraints
            );
        } catch (e) {
            console.log("webrtc: microphone permission denied...");
        }

        this.mute();

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
	if (!this.audio_input_id) return;
        console.log("webrtc: try audio %s", this.audio_input_id);
        this.mediaConstraints.audio.deviceId = { exact: this.audio_input_id };
        this.stream?.getAudioTracks()[0].stop();

        try {
            let new_stream = await navigator.mediaDevices.getUserMedia(
                this.mediaConstraints
            );

            this.stream = new_stream;

            this.stream.getAudioTracks().forEach((track) => {
                track.enabled = !this.muted;
            });

            let track = this.stream.getAudioTracks()[0];

            console.log(
                "webrtc: changed audio: " + track.getSettings().deviceId
            );

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

    async audio_output_changed() {
        if (!this.audio_output_id) return;
        console.log("webrtc: try change output");
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
	
        await audio.setSinkId(this.audio_output_id);
        console.log("webrtc: changed output");
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

    stop() {
        console.log("webrtc: stop");
	this.hangup();
        this.stream?.getAudioTracks()[0].stop();
        this.stream = null;
        this.audio_input_id =  null;
	this.audio_output_id = null;
	this.audio_inputs = [];
	this.audio_outputs = undefined;
        this.mediaConstraints = this.mediaConstraints_default;
    },

    hangup() {
        console.log("webrtc: hangup");
	
        this.webrtc = false;
	if (this.room_slug) {
		axios.get("/webrtc/" + this.room_slug + "/disconnect").then(() => {
		    this.isListening = false;
		});
	}
        if (pc) {
            pc.close();
            pc = null;
        }
        if (this.room_slug != "echo") Livewire.emit("webrtcOffline");
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
            } else {
                console.log(
                    "webrtc/icecandidate: " +
                        event.candidate.type +
                        " IP: " +
                        event.candidate.candidate
                );
            }
        };

        pc.onicegatheringstatechange = (event) => {
            console.log(
                "webrtc/iceGatheringState: " + event.target.iceGatheringState
            );
        };

        pc.onsignalingstatechange = (event) => {
            console.log(
                "webrtc/signalingState: " + event.target.signalingState
            );
        };

        pc.onicecandidateerror = function (event) {
            console.log(
                "ICE Candidate Error: " +
                    event.errorCode +
                    " " +
                    event.errorText
            );
        };

        pc.ontrack = function (event) {
            const track = event.track;
            let audio = document.querySelector("audio#audio");
            console.log("got remote track: kind=%s", track.kind);

            if (audio.srcObject !== event.streams[0]) {
                audio.srcObject = event.streams[0];
                console.log("received remote audio stream");
            }
        };

        pc.oniceconnectionstatechange = (event) => {
            console.log(
                "webrtc/iceConnectionState: " + event.target.iceConnectionState
            );

            if (event.target.iceConnectionState === "completed") return;

            if (event.target.iceConnectionState === "connected") {
                console.log("webrtc: online, room: " + this.room_slug);
                if (this.room_slug != "echo") Livewire.emit("webrtcReady");
            } else {
                console.log("webrtc: offline, room: " + this.room_slug);
                if (this.room_slug != "echo") Livewire.emit("webrtcOffline");
            }
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
};
