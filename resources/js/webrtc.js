import axios from "axios";

let pc; /* PeerConnection */
let localStream; /* MediaStream */

function pc_offer() {
    const offerOptions = {
        iceRestart: false,
        voiceActivityDetection: true,
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

export default () => ({
    isListening: false,

    init() {
        console.log("webrtc:init");
        Echo.private("webrtc.sdp." + window.user_id).listen(
            "WebrtcSDP",
            (e) => {
                this.sdp(e);
            }
        );
    },

    start() {
        console.log("webrtc:start");
        this.isListening = true;
        const configuration = {
            bundlePolicy: "balanced",

            iceCandidatePoolSize: 0,
            iceTransportPolicy: "relay",
            // iceServers: [
            //     {
            //         urls: "stun:stun.l.google.com:19302",
            //     },
            // ],
            iceServers: [
                {
                    urls: "turn:195.201.63.86:3478",
                    username: "turn200301",
                    credential: "choh4zeem3foh1"
                }
            ],
            // iceTransportPolicy: "all",
        };
        const constraints = { audio: true, video: false };

        pc = new RTCPeerConnection(configuration);

        pc.onicecandidate = (event) => {
            if (event.candidate === null) {
                const sd = pc.localDescription;
                const json = JSON.stringify(sd);

                axios.post("/webrtc/sdp", json);
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
            let audio = document.querySelector('audio#audio');
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

        navigator.mediaDevices
            .getUserMedia(constraints)
            .then(function (stream) {
                // save the stream
                localStream = stream;

                // type: MediaStreamTrack
                const audioTracks = localStream.getAudioTracks();
                // const videoTracks = localStream.getVideoTracks();

                if (audioTracks.length > 0) {
                    console.log(
                        "Using Audio device: '%s'",
                        audioTracks[0].label
                    );
                }
                // if (videoTracks.length > 0) {
                //     console.log(
                //         "Using Video device: '%s'",
                //         videoTracks[0].label
                //     );
                // }

                localStream
                    .getTracks()
                    .forEach((track) => pc.addTrack(track, localStream));

                pc_offer();
            })
            .catch(function (error) {
                alert("Get User Media: " + error);
            });
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
            axios.get("/webrtc/disconnect").then(() => {
                this.isListening = false;
            });
            return;
        }

        this.start();
        //this.isListening = true;
    },
});
