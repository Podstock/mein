<x-jet-dialog-modal wire:model="modal_options">

    <x-slot name="title">
        <div class="text-center">Optionen</div>
    </x-slot>
    <x-slot name="content">
        <!-- This example requires Tailwind CSS v2.0+ -->
        <div>
            <dl x-data
                class="mt-5 grid grid-cols-1 rounded-lg bg-white overflow-hidden shadow divide-y divide-gray-200 max-w-md mx-auto">

                <button x-show="!$store.webrtc_video.webrtc_video" @click="$store.webrtc_video.room_connect()"
                    type="button" class="px-4 py-5 sm:p-6 hover:bg-gray-300">
                    <dt class="text-base font-bold text-gray-900 text-center mb-2">
                        Video Wiedergabe
                    </dt>
                    <dd class="text-gray-700">
                        <svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="photo-film"
                            class="h-12 w-12 mx-auto" role="img" xmlns="http://www.w3.org/2000/svg"
                            viewBox="0 0 640 512">
                            <path fill="currentColor"
                                d="M352 432c0 8.836-7.164 16-16 16H176c-8.838 0-16-7.164-16-16L160 128H48C21.49 128 .0003 149.5 .0003 176v288c0 26.51 21.49 48 48 48h416c26.51 0 48-21.49 48-48L512 384h-160L352 432zM104 439c0 4.969-4.031 9-9 9h-30c-4.969 0-9-4.031-9-9v-30c0-4.969 4.031-9 9-9h30c4.969 0 9 4.031 9 9V439zM104 335c0 4.969-4.031 9-9 9h-30c-4.969 0-9-4.031-9-9v-30c0-4.969 4.031-9 9-9h30c4.969 0 9 4.031 9 9V335zM104 231c0 4.969-4.031 9-9 9h-30c-4.969 0-9-4.031-9-9v-30C56 196 60.03 192 65 192h30c4.969 0 9 4.031 9 9V231zM408 409c0-4.969 4.031-9 9-9h30c4.969 0 9 4.031 9 9v30c0 4.969-4.031 9-9 9h-30c-4.969 0-9-4.031-9-9V409zM591.1 0H239.1C213.5 0 191.1 21.49 191.1 48v256c0 26.51 21.49 48 48 48h352c26.51 0 48-21.49 48-48v-256C640 21.49 618.5 0 591.1 0zM303.1 64c17.68 0 32 14.33 32 32s-14.32 32-32 32C286.3 128 271.1 113.7 271.1 96S286.3 64 303.1 64zM574.1 279.6C571.3 284.8 565.9 288 560 288H271.1C265.1 288 260.5 284.6 257.7 279.3C255 273.9 255.5 267.4 259.1 262.6l70-96C332.1 162.4 336.9 160 341.1 160c5.11 0 9.914 2.441 12.93 6.574l22.35 30.66l62.74-94.11C442.1 98.67 447.1 96 453.3 96c5.348 0 10.34 2.672 13.31 7.125l106.7 160C576.6 268 576.9 274.3 574.1 279.6z">
                            </path>
                        </svg>
                    </dd>
                </button>

                <button x-show="!$wire.webrtc_video && window.user?.type == 'speaker'" wire:click="$emit('toggleCam')"
                    type="button" class="px-4 py-5 sm:p-6 hover:bg-gray-300">
                    <dt class="text-base font-bold text-gray-900 text-center mb-2">
                        Kamera aktivieren
                    </dt>
                    <dd class="text-gray-700">
                        <svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="camera-web"
                            class="h-12 w-12 mx-auto" role="img" xmlns="http://www.w3.org/2000/svg"
                            viewBox="0 0 448 512">
                            <path fill="currentColor"
                                d="M400.9 438.6l-49.12-30.75C409.9 367.4 448 300.3 448 224c0-123.8-100.4-224-224-224c-123.8 0-224 100.3-224 224c0 76.25 38.13 143.4 96.13 183.9L47 438.6C37.63 444.5 32 454.8 32 465.8v14.25c0 17.62 14.48 31.1 32.11 31.1L384 512c17.62 0 32-14.38 32-32V465.8C416 454.8 410.3 444.5 400.9 438.6zM224 384c-88.37 0-160.1-71.62-160.1-159.1s71.63-160 159.1-160s160 71.62 160 160S312.3 384 224 384zM224 96C153.4 96 95.92 153.2 95.92 224s57.38 128 128 128c70.75 0 128-57.25 128-128C351.9 153.4 294.6 96 224 96zM223.9 176c-26.5 0-47.87 21.5-48 48c0 8.875-7.125 16-16 16c-8.75 0-16-7.125-16-16c.125-44.12 35.92-80 80.04-80c8.875 0 15.96 7.125 15.96 16S232.8 176 223.9 176z">
                            </path>
                        </svg>
                    </dd>
                </button>
                <button x-show="!$wire.webrtc_video && window.user?.type == 'speaker'"
                    @click="$store.webrtc_video.setup_screen()" type="button"
                    class="px-4 py-5 sm:p-6 hover:bg-gray-300">
                    <dt class="text-base font-bold text-gray-900 text-center mb-2">
                        Bildschirm freigeben
                    </dt>
                    <dd class="text-gray-700">
                        <svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="display"
                            class="h-12 w-12 mx-auto" role="img" xmlns="http://www.w3.org/2000/svg"
                            viewBox="0 0 576 512">
                            <path fill="currentColor"
                                d="M528 0h-480C21.5 0 0 21.5 0 48v320C0 394.5 21.5 416 48 416h192L224 464H152C138.8 464 128 474.8 128 488S138.8 512 152 512h272c13.25 0 24-10.75 24-24s-10.75-24-24-24H352L336 416h192c26.5 0 48-21.5 48-48v-320C576 21.5 554.5 0 528 0zM512 352H64V64h448V352z">
                            </path>
                        </svg>
                    </dd>
                </button>

                <button x-show="$wire.webrtc_video" @click="$store.webrtc_video.disable_cam()" type="button"
                    class="px-4 py-5 sm:p-6 hover:bg-gray-300">
                    <dt class="text-base font-bold text-gray-900 text-center mb-2">
                        Kamera/Bildschirm Freigabe deaktivieren
                    </dt>
                    <dd class="text-gray-700">

                        <svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="camera-web-slash"
                            class="h-12 w-12 mx-auto" role="img" xmlns="http://www.w3.org/2000/svg"
                            viewBox="0 0 640 512">
                            <path fill="currentColor"
                                d="M319.1 383.1c-88.37 0-160.1-71.63-160.1-159.1c0-.6406 .1816-1.234 .1895-1.871L101.3 176C97.89 191.5 95.1 207.5 95.1 223.1c0 76.25 38.12 143.4 96.12 183.9l-49.12 30.75c-9.375 5.875-14.1 16.12-14.1 27.12v14.25c0 17.62 14.48 32 32.11 32l319.9-.0053c12.21 0 22.52-7.136 27.91-17.23l-148.4-116.3C346.8 381.7 333.7 383.1 319.1 383.1zM630.8 469.1l-135.7-106.4c30.42-38.12 48.92-86.1 48.92-138.7c0-123.7-100.4-223.1-223.1-223.1c-72.02 0-135.7 34.24-176.6 87.04L38.81 5.113C34.41 1.676 29.19 .0042 24.03 .0042c-7.125 0-14.19 3.156-18.91 9.187c-8.187 10.44-6.37 25.53 4.068 33.7l591.1 463.1c10.5 8.203 25.57 6.328 33.69-4.078C643.1 492.4 641.3 477.3 630.8 469.1zM319.9 175.1c-15.75 0-29.04 8.086-37.72 19.84l-25.66-20.11c14.55-19.23 37.47-31.72 63.42-31.72c8.875 0 15.96 7.124 15.96 15.1S328.7 175.1 319.9 175.1zM444.6 323.2L419.4 303.4c17.62-21.78 28.5-49.16 28.5-79.41c0-70.62-57.29-127.1-127.9-127.1c-41.28 0-77.63 19.93-100.9 50.38L193.9 126.6C223 88.71 268.3 63.1 319.9 63.1c88.37 0 159.1 71.62 159.1 159.1C479.9 261.7 466.5 295.9 444.6 323.2z">
                            </path>
                        </svg>
                    </dd>
                </button>

                {{-- <button type="button" class="px-4 py-5 sm:p-6 hover:bg-gray-300">
                    <dt class="text-base font-bold text-gray-900 text-center mb-2">
                        Audio Optionen
                    </dt>
                    <dd class="text-gray-700">
                        <svg class="h-12 w-12 mx-auto" aria-hidden="true" focusable="false" data-prefix="fas"
                            data-icon="headset" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                            <path fill="currentColor"
                                d="M191.1 224c0-17.72-14.34-32.04-32-32.04L144 192c-35.34 0-64 28.66-64 64.08v47.79C80 339.3 108.7 368 144 368H160c17.66 0 32-14.36 32-32.06L191.1 224zM256 0C112.9 0 4.583 119.1 .0208 256L0 296C0 309.3 10.75 320 23.1 320S48 309.3 48 296V256c0-114.7 93.34-207.8 208-207.8C370.7 48.2 464 141.3 464 256v144c0 22.09-17.91 40-40 40h-110.7C305 425.7 289.7 416 272 416H241.8c-23.21 0-44.5 15.69-48.87 38.49C187 485.2 210.4 512 239.1 512H272c17.72 0 33.03-9.711 41.34-24H424c48.6 0 88-39.4 88-88V256C507.4 119.1 399.1 0 256 0zM368 368c35.34 0 64-28.7 64-64.13V256.1C432 220.7 403.3 192 368 192l-16 0c-17.66 0-32 14.34-32 32.04L320 335.9C320 353.7 334.3 368 352 368H368z">
                            </path>
                        </svg>
                    </dd>
                </button> --}}
                <button @click="$store.webrtc.hangup(); $store.webrtc_video.stop()" type="button"
                    class="px-4 py-5 sm:p-6 hover:bg-gray-300">
                    <dt class="text-base font-bold text-gray-900 text-center mb-2">
                        Verbindung beenden
                    </dt>
                    <dd class="text-gray-700">
                        <svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="right-from-bracket"
                            class="h-12 w-12 mx-auto" role="img" xmlns="http://www.w3.org/2000/svg"
                            viewBox="0 0 512 512">
                            <path fill="currentColor"
                                d="M96 480h64C177.7 480 192 465.7 192 448S177.7 416 160 416H96c-17.67 0-32-14.33-32-32V128c0-17.67 14.33-32 32-32h64C177.7 96 192 81.67 192 64S177.7 32 160 32H96C42.98 32 0 74.98 0 128v256C0 437 42.98 480 96 480zM504.8 238.5l-144.1-136c-6.975-6.578-17.2-8.375-26-4.594c-8.803 3.797-14.51 12.47-14.51 22.05l-.0918 72l-128-.001c-17.69 0-32.02 14.33-32.02 32v64c0 17.67 14.34 32 32.02 32l128 .001l.0918 71.1c0 9.578 5.707 18.25 14.51 22.05c8.803 3.781 19.03 1.984 26-4.594l144.1-136C514.4 264.4 514.4 247.6 504.8 238.5z">
                            </path>
                        </svg>
                    </dd>
                </button>
            </dl>
        </div>


    </x-slot>

    <x-slot name="footer">
    </x-slot>

</x-jet-dialog-modal>
