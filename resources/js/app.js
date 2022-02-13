require("./bootstrap");
// import videojs from "video.js";
// require("videojs-contrib-quality-levels");
// require("videojs-http-source-selector");
// require("!style-loader!css-loader!video.js/dist/video-js.css");

import Alpine from "alpinejs";
import intersect from "@alpinejs/intersect";

import webrtc from "./webrtc.js";
import webrtc_video from "./webrtc_video.js";
import users from "./users.js";

window.Alpine = Alpine;
// window.videojs = videojs;

Alpine.plugin(intersect);
Alpine.data("app", () => ({
    version: process.env.MIX_VERSION,
}));

Alpine.store("webrtc", webrtc);
Alpine.store("webrtc_video", webrtc_video);
Alpine.data("users", users);

Alpine.start();
