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
    webrtc_video: false,
    stream: null,
    video_id: null,
    video_inputs: [],
    room_slug: undefined,
    echo: false,
    echo_failed: false,

    mediaConstraints: {
        audio: false,
        video: { width: 640, height: 480, framerate: 30 },
    },

    init() {
        console.log("webrtc_video:init");
        Echo.private("webrtc_video.sdp." + window.user_id).listen(
            "WebrtcSDPVideo",
            (e) => {
                this.sdp(e);
            }
        );

        Echo.private("webrtc_video.ready." + window.user_id).listen(
            "WebrtcVideoReady",
            (e) => {
                this.room_connect();
            }
        );

        this.room_connect();
    },

    echo_connect() {
        this.room_slug = "echo";
        this.hangup();
        this.start();
        this.echo = true;
        this.echo_failed = false;
    },

    echo_yes() {
        this.hangup();
        this.room_connect();
        this.echo = false;
        this.echo_failed = false;
    },

    echo_no() {
        this.hangup();
        this.echo = false;
        this.echo_failed = true;
    },

    room_connect() {
        this.webrtc_video = true;
        this.room_slug = window.room_slug;
        this.start();
    },

    async setup() {
        console.log("webrtc_video:setup");

        try {
            this.stream = await navigator.mediaDevices.getUserMedia(
                this.mediaConstraints
            );
        } catch (e) {
            console.log("webrtc_video: permission denied...");
        }
    },

    hangup() {
        console.log("webrtc_video: hangup");
        this.webrtc_video = false;
        axios.get("/webrtc_video/" + this.room_slug + "/disconnect");
        if (pc) {
            pc.close();
            pc = null;
        }
        // Livewire.emit("webrtc_videoOffline");
    },

    restart() {
        this.hangup();
        this.start();
    },

    start() {
        console.log("webrtc_video:start");
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

                axios.post("/webrtc_video/" + this.room_slug + "/sdp", json);
            } else {
                console.log(
                    "webrtc_video/icecandidate: " +
                        event.candidate.type +
                        " IP: " +
                        event.candidate.candidate
                );
            }
        };

        pc.onicegatheringstatechange = (event) => {
            console.log(
                "webrtc_video/iceGatheringState: " +
                    event.target.iceGatheringState
            );
        };

        pc.onsignalingstatechange = (event) => {
            console.log(
                "webrtc_video/signalingState: " + event.target.signalingState
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
            let remoteVideo = document.querySelector("video#video");
            console.log("got remote track: kind=%s", track.kind);

            if (remoteVideo.srcObject !== event.streams[0]) {
                remoteVideo.srcObject = event.streams[0];
                console.log("received remote video stream");
            }
        };

        pc.oniceconnectionstatechange = (event) => {
            console.log(
                "webrtc_video/iceConnectionState: " +
                    event.target.iceConnectionState
            );

            if (event.target.iceConnectionState === "completed") return;
            if (event.target.iceConnectionState === "connected") {
                console.log("webrtc_video: online, room: " + this.room_slug);
                // if (this.room_slug != "echo") Livewire.emit("webrtc_videoReady");
            } else {
                console.log("webrtc_video: offline, room: " + this.room_slug);
                // if (this.room_slug != "echo") Livewire.emit("webrtc_videoOffline");
            }
        };

        // this.stream
        //     .getTracks()
        //     .forEach((track) => pc.addTrack(track, this.stream));

        pc.addTransceiver("video", { direction: "recvonly" });

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
