require("./bootstrap");
import Alpine from "alpinejs";
import intersect from "@alpinejs/intersect";

import webrtc from "./webrtc.js";
import users from "./users.js";

window.Alpine = Alpine;

Alpine.plugin(intersect);
Alpine.data("app", () => ({
    version: process.env.MIX_VERSION,
}));

Alpine.store("webrtc", webrtc);
Alpine.data("users", users);

Alpine.start();
