require("./bootstrap");
import Alpine from "alpinejs";
import webrtc from "./webrtc.js";
import users from "./users.js";

window.Alpine = Alpine;

Alpine.data("app", () => ({
    version: process.env.MIX_VERSION,
}));

Alpine.data('stream_webrtc', webrtc);
Alpine.data('users', users);

Alpine.start();
