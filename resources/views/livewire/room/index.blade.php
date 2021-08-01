<div>
    <audio id="audio" autoplay></audio>
    <div class="flex">
        <main class="w-full">
            @include('room.users')
        </main>
        <livewire:room.chat :room="$room" />
    </div>
    <livewire:room.actions :room="$room" />

    <x-jet-dialog-modal wire:model="launch">

        <x-slot name="title">
            <div class="text-center">Wie möchtest du dich verbinden?</div>
        </x-slot>
        <x-slot name="content">
            <!-- This example requires Tailwind CSS v2.0+ -->
            <div class="">
                <dl
                    class="mt-5 grid grid-cols-1 rounded-lg bg-white overflow-hidden shadow divide-y divide-gray-200 md:grid-cols-3 md:divide-y-0 md:divide-x">
                    <button type="button" class="px-4 p-5 hover:bg-green-100">
                        <dt class="text-base font-normal text-gray-900 text-center mb-2">
                            Mit Headset
                        </dt>
                        <dd class="mt-1 flex justify-between items-baseline md:block lg:flex">

                            <svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="headset"
                                class="h-12 w-12 mx-auto" role="img" xmlns="http://www.w3.org/2000/svg"
                                viewBox="0 0 512 512">
                                <path fill="currentColor"
                                    d="M191.1 224c0-17.72-14.34-32.04-32-32.04L144 192c-35.34 0-64 28.66-64 64.08v47.79C80 339.3 108.7 368 144 368H160c17.66 0 32-14.36 32-32.06L191.1 224zM256 0C112.9 0 4.583 119.1 .0208 256L0 296C0 309.3 10.75 320 23.1 320S48 309.3 48 296V256c0-114.7 93.34-207.8 208-207.8C370.7 48.2 464 141.3 464 256v144c0 22.09-17.91 40-40 40h-110.7C305 425.7 289.7 416 272 416H241.8c-23.21 0-44.5 15.69-48.87 38.49C187 485.2 210.4 512 239.1 512H272c17.72 0 33.03-9.711 41.34-24H424c48.6 0 88-39.4 88-88V256C507.4 119.1 399.1 0 256 0zM368 368c35.34 0 64-28.7 64-64.13V256.1C432 220.7 403.3 192 368 192l-16 0c-17.66 0-32 14.34-32 32.04L320 335.9C320 353.7 334.3 368 352 368H368z">
                                </path>
                            </svg>
                        </dd>
                    </button>

                    <button type="button" class="px-4 p-5">
                        <dt class="text-base font-normal text-gray-900 text-center">
                            MP3 Livestream
                        </dt>
                        <dd class="mt-1 flex justify-between items-baseline md:block lg:flex">
                            <svg class="h-12 w-12 mx-auto" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                                fill="currentColor">
                                <path fill-rule="evenodd"
                                    d="M10 18a8 8 0 100-16 8 8 0 000 16zM9.555 7.168A1 1 0 008 8v4a1 1 0 001.555.832l3-2a1 1 0 000-1.664l-3-2z"
                                    clip-rule="evenodd" />
                            </svg>
                        </dd>
                    </button>

                    <div class="px-4 py-5 sm:p-6">
                        <dt class="text-base font-normal text-gray-900">
                            Video Livestream
                        </dt>
                        <dd class="mt-1 flex justify-between items-baseline md:block lg:flex">

                        </dd>
                    </div>
                </dl>
            </div>

        </x-slot>

        <x-slot name="footer">
        </x-slot>

    </x-jet-dialog-modal>

    <script>
        window.room_id = "{{$room->id}}";
    </script>
</div>
