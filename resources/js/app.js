require("./bootstrap");
import Alpine from "alpinejs";

window.Alpine = Alpine;

Alpine.data("app", () => ({
    version: process.env.MIX_VERSION,
}));

Alpine.start();
