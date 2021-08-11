<div>
    <div x-data x-show="window.self !== window.top" x-cloak class="absolute right-0 text-gray-300 mt-4 mr-4">
        <a href="https://mein.podstock.de/room/{{$room->slug}}" target="_blank">
            <svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="arrow-up-right-from-square"
                class="h-8 w-8" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                <path fill="currentColor"
                    d="M384 320c-17.67 0-32 14.33-32 32v96H64V160h96c17.67 0 32-14.32 32-32s-14.33-32-32-32L64 96c-35.35 0-64 28.65-64 64V448c0 35.34 28.65 64 64 64h288c35.35 0 64-28.66 64-64v-96C416 334.3 401.7 320 384 320zM502.6 9.367C496.8 3.578 488.8 0 480 0h-160c-17.67 0-31.1 14.32-31.1 31.1c0 17.67 14.32 31.1 31.99 31.1h82.75L178.7 290.7c-12.5 12.5-12.5 32.76 0 45.26C191.2 348.5 211.5 348.5 224 336l224-226.8V192c0 17.67 14.33 31.1 31.1 31.1S512 209.7 512 192V31.1C512 23.16 508.4 15.16 502.6 9.367z">
                </path>
            </svg>
        </a>
    </div>
    <div class="flex">
        <main class="w-full">
            <video x-data x-show="$store.webrtc_video.webrtc_video" x-cloak id="live" playsinline autoplay class="mx-auto px-4 mt-2" height="640"
                width="480"></video>
            @include('room.users')
        </main>
        <livewire:room.chat :room="$room" />
    </div>
    <livewire:room.actions :room="$room" />

    <div>
        <audio id="audio" autoplay></audio>
        @include('room.connect')
        @include('room.echo')
        @include('room.user')
        @include('room.options')
        @include('room.cam')
    </div>

    {{-- Empty div to fix height (action menu) --}}
    <div class="h-20"></div>

    <script>
        window.room_slug = "{{$room->slug}}";
    </script>
</div>
