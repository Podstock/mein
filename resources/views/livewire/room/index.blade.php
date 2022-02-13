<div>
    <div x-data x-show="window.self !== window.top" x-cloak class="absolute right-0 text-gray-300 mt-4 mr-4">
        <a href="#" onclick="window.open('/room/{{$room->slug}}', 'popUpWindow', 'height=700,width=800,left=100,top=100,resizable=yes,scrollbars=yes,toolbar=yes,menubar=no,location=no,directories=no, status=yes')";>
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
            <div x-data="{nav: false}" @mouseover="nav = true" @mouseleave="nav = false"
                x-show="$store.webrtc_video.webrtc_video" x-cloak>

                <div x-show="nav" class="text-center mt-2 text-gray-500">
                    <button @click="$refs.video.width=$refs.video.width+64" class="text-lg" title="Vergößern">
                        <svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="magnifying-glass-plus"
                            class="h-8 w-8" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                            <path fill="currentColor"
                                d="M500.3 443.7l-119.7-119.7c27.22-40.41 40.65-90.9 33.46-144.7c-12.23-91.55-87.28-166-178.9-177.6c-136.2-17.24-250.7 97.28-233.4 233.4c11.6 91.64 86.07 166.7 177.6 178.9c53.81 7.191 104.3-6.235 144.7-33.46l119.7 119.7c15.62 15.62 40.95 15.62 56.57 .0003C515.9 484.7 515.9 459.3 500.3 443.7zM288 232H231.1V288c0 13.26-10.74 24-23.1 24C194.7 312 184 301.3 184 288V232H127.1C114.7 232 104 221.3 104 208s10.74-24 23.1-24H184V128c0-13.26 10.74-24 23.1-24S231.1 114.7 231.1 128v56h56C301.3 184 312 194.7 312 208S301.3 232 288 232z">
                            </path>
                        </svg>
                    </button>
                    <button @click="$refs.video.width=$refs.video.width-64" class="text-lg ml-8" title="Verkleinern">
                        <svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="magnifying-glass-minus"
                            class="h-8 w-8" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                            <path fill="currentColor"
                                d="M500.3 443.7l-119.7-119.7c27.22-40.41 40.65-90.9 33.46-144.7c-12.23-91.55-87.28-166-178.9-177.6c-136.2-17.24-250.7 97.28-233.4 233.4c11.6 91.64 86.07 166.7 177.6 178.9c53.81 7.191 104.3-6.235 144.7-33.46l119.7 119.7c15.62 15.62 40.95 15.62 56.57 .0003C515.9 484.7 515.9 459.3 500.3 443.7zM288 232H127.1C114.7 232 104 221.3 104 208s10.74-24 23.1-24h160C301.3 184 312 194.7 312 208S301.3 232 288 232z">
                            </path>
                        </svg>
                    </button>
                    <button @click="$refs.video.requestFullscreen()" class="text-lg ml-8" title="Fullscreen">
                        <svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="expand" class="h-8 w-8"
                            role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
                            <path fill="currentColor"
                                d="M128 32H32C14.31 32 0 46.31 0 64v96c0 17.69 14.31 32 32 32s32-14.31 32-32V96h64c17.69 0 32-14.31 32-32S145.7 32 128 32zM416 32h-96c-17.69 0-32 14.31-32 32s14.31 32 32 32h64v64c0 17.69 14.31 32 32 32s32-14.31 32-32V64C448 46.31 433.7 32 416 32zM128 416H64v-64c0-17.69-14.31-32-32-32s-32 14.31-32 32v96c0 17.69 14.31 32 32 32h96c17.69 0 32-14.31 32-32S145.7 416 128 416zM416 320c-17.69 0-32 14.31-32 32v64h-64c-17.69 0-32 14.31-32 32s14.31 32 32 32h96c17.69 0 32-14.31 32-32v-96C448 334.3 433.7 320 416 320z">
                            </path>
                        </svg>
                    </button>
                    <button @click="$store.webrtc_video.stop()" class="text-lg ml-8 text-red-300" title="Video schließen">
                        <svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="hexagon-xmark"
                            class="h-8 w-8" role="img"
                            xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                            <path fill="currentColor"
                                d="M505.8 233.4l-105.4-179.2C392.3 40.52 377.5 32 361.4 32H150.6C134.5 32 119.7 40.52 111.6 54.17L6.176 233.4c-8.234 14-8.234 31.27 0 45.27l105.4 179.2C119.7 471.5 134.5 480 150.6 480h210.8c16.12 0 30.94-8.518 39.05-22.17l105.4-179.2C514.1 264.6 514.1 247.4 505.8 233.4zM336.1 303c9.375 9.375 9.375 24.56 0 33.94c-9.381 9.381-24.56 9.373-33.94 0L256 289.9l-47.03 47.03c-9.381 9.381-24.56 9.373-33.94 0c-9.375-9.375-9.375-24.56 0-33.94l47.03-47.03L175 208.1c-9.375-9.375-9.375-24.56 0-33.94s24.56-9.375 33.94 0L256 222.1l47.03-47.03c9.375-9.375 24.56-9.375 33.94 0s9.375 24.56 0 33.94l-47.03 47.03L336.1 303z">
                            </path>
                        </svg>
                    </button>
                </div>
                <video x-ref="video" id="live" playsinline autoplay class="mx-auto px-4 mt-2" height="640"
                    width="480"></video>
            </div>
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
