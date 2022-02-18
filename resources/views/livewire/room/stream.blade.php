<div class="pb-8 mt-4 mb-4 border-b w-full">
    <video id="stream" class="video-js vjs-default-skin mx-auto" controls preload="auto"
        poster="/preview_livestream.png" data-setup="{}" width="640" height="480">
        <p class="vjs-no-js">
            To view this video please enable JavaScript, and consider upgrading
            to a web browser that
            <a href="https://videojs.com/html5-video-support/" target="_blank">supports HTML5 video</a>
        </p>
        <source src="https://live.podstock.de/hls/{{$room->slug}}_src.m3u8" type="application/x-mpegURL" />
<!--
        <source src="https://stream-master.studio-link.de/podstock2021{{$room->slug}}.mp3" type="audio/mp3" />
-->
    </video>


    <ul class="list-reset flex flex-wrap mt-8 mb-4 justify-center text-lg">
        <li class="mr-3">
            <a href="/stream/innenbuehne" @class(['p-2 rounded-lg', 'bg-green-700 text-white'=> $room->slug ===
                'innenbuehne'])>Innenbühne</a>
        </li>
    </ul>

    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 text-center mt-8 border-t pt-2">
        <a href="/room/{{$room->slug}}"
            class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-normal font-bold rounded-md text-white bg-green-700 hover:bg-green-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
            Zum Raum</a>
        <div class="mt-4 text-sm">
            Falls du interaktiv teilnehmen möchtest (Fragen stellen etc.) kannst du dich auch einwählen.
        </div>
    </div>


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
