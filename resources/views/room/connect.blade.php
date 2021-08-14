<x-jet-dialog-modal wire:model="connect">

    <x-slot name="title">
        <div class="text-center">Wie möchtest du dich verbinden?</div>
    </x-slot>
    <x-slot name="content">
        <div>
            <dl
                class="mt-5 grid grid-cols-1 rounded-lg bg-white overflow-hidden shadow divide-y divide-gray-200">
                {{-- WebRTC --}}
                <button wire:click="webrtc" type="button" class="px-4 p-5 hover:bg-gray-300 flex flex-col">
                    <dt class="text-base font-bold text-gray-900 text-center mb-2 w-full">
                        Headset
                    </dt>
                    <dd class="mt-1 flex flex-col w-full">

                        <svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="headset"
                            class="h-8 w-8 sm:h-12 sm:w-12 mx-auto" role="img" xmlns="http://www.w3.org/2000/svg"
                            viewBox="0 0 512 512">
                            <path fill="currentColor"
                                d="M191.1 224c0-17.72-14.34-32.04-32-32.04L144 192c-35.34 0-64 28.66-64 64.08v47.79C80 339.3 108.7 368 144 368H160c17.66 0 32-14.36 32-32.06L191.1 224zM256 0C112.9 0 4.583 119.1 .0208 256L0 296C0 309.3 10.75 320 23.1 320S48 309.3 48 296V256c0-114.7 93.34-207.8 208-207.8C370.7 48.2 464 141.3 464 256v144c0 22.09-17.91 40-40 40h-110.7C305 425.7 289.7 416 272 416H241.8c-23.21 0-44.5 15.69-48.87 38.49C187 485.2 210.4 512 239.1 512H272c17.72 0 33.03-9.711 41.34-24H424c48.6 0 88-39.4 88-88V256C507.4 119.1 399.1 0 256 0zM368 368c35.34 0 64-28.7 64-64.13V256.1C432 220.7 403.3 192 368 192l-16 0c-17.66 0-32 14.34-32 32.04L320 335.9C320 353.7 334.3 368 352 368H368z">
                            </path>
                        </svg>
                        <div class="text-center w-full mt-4 text-sm text-gray-500">
                            Du kannst jederzeit am Gespräch teilnehmen und hast minimale Latenz.
                        </div>
                    </dd>
                </button>
                @if($room->show)
                {{-- Livestream HLS/VIDEO --}}
                <a href="/stream/{{$room->slug}}" class="px-4 p-5 hover:bg-gray-300 flex flex-col">
                    <dt class="text-base font-bold text-gray-900 text-center mb-2 w-full">
                        Video Livestream
                    </dt>
                    <dd class="mt-1 flex flex-col w-full">
                        <svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="video"
                            class="h-8 w-8 sm:h-12 sm:w-12 mx-auto" role="img" xmlns="http://www.w3.org/2000/svg"
                            viewBox="0 0 576 512">
                            <path fill="currentColor"
                                d="M384 112v288c0 26.51-21.49 48-48 48h-288c-26.51 0-48-21.49-48-48v-288c0-26.51 21.49-48 48-48h288C362.5 64 384 85.49 384 112zM576 127.5v256.9c0 25.5-29.17 40.39-50.39 25.79L416 334.7V177.3l109.6-75.56C546.9 87.13 576 102.1 576 127.5z">
                            </path>
                        </svg>
                        <div class="text-center mt-4 text-sm text-gray-500">
                            Wenn Bandbreite und Latenz keine Rolle spielen (nicht alle Streams haben Videoinhalte).
                        </div>
                    </dd>
                </a>
                @endif
            </dl>
        </div>

    </x-slot>

    <x-slot name="footer">
    </x-slot>

</x-jet-dialog-modal>
