<div class="pb-8 mb-4 border-b lg:w-2/3 mx-auto">
    <video
        id="stream"
        class="video-js vjs-default-skin"
        controls
        preload="auto"
        poster="/preview_livestream.png"
        data-setup="{}"
        width="640"
        height="480"
    >
        <p class="vjs-no-js">
            To view this video please enable JavaScript, and consider upgrading
            to a web browser that
            <a href="https://videojs.com/html5-video-support/" target="_blank"
                >supports HTML5 video</a
            >
        </p>
        <source
            src="https://live.podstock.de/hls/aussen_src.m3u8"
            type="application/x-mpegURL"
        />
        <source
            src="https://stream-master.studio-link.de/podstock2021aussen.mp3"
            type="audio/mp3"
        />
    </video>
    <!-- <script>
        document.addEventListener("livewire:load", function () {
            var options = {
                plugins: {
                    httpSourceSelector: {
                        default: "high",
                    },
                },
            };
            let player = videojs("stream", options);
            player.httpSourceSelector();
        });
    </script> -->
</div>
