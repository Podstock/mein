<x-jet-dialog-modal wire:model="modal_cam">

    <x-slot name="title">
        <div class="text-center">Kamera wählen/testen</div>
    </x-slot>
    <x-slot name="content">
        <div x-data x-intersect="$store.webrtc_video.setup()"
            x-init="$watch('$store.webrtc_video.input_id', () => $store.webrtc_video.input_changed())">
            <label for="cam" class="text-left block text-sm font-bold text-gray-700">Kamera</label>
        <div class="flex">
                <select x-model="$store.webrtc_video.input_id" id="cam" name="cam"
                class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-green-700 focus:border-green-700 sm:text-sm  rounded-md">
                        <template x-for="cam in $store.webrtc_video.inputs">
                            <option x-text="cam.value" :value="cam.key"></option>
                        </template>
                </select>
                <x-jet-button class="ml-2" @click="$store.webrtc_video.setup()">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                          <path fill-rule="evenodd" d="M4 2a1 1 0 011 1v2.101a7.002 7.002 0 0111.601 2.566 1 1 0 11-1.885.666A5.002 5.002 0 005.999 7H9a1 1 0 010 2H4a1 1 0 01-1-1V3a1 1 0 011-1zm.008 9.057a1 1 0 011.276.61A5.002 5.002 0 0014.001 13H11a1 1 0 110-2h5a1 1 0 011 1v5a1 1 0 11-2 0v-2.101a7.002 7.002 0 01-11.601-2.566 1 1 0 01.61-1.276z" clip-rule="evenodd" />
                        </svg>
                </x-jet-button>
        </div>
        <x-jet-button class="mt-2" @click="$store.webrtc_video.echo_ready()">Übernehmen</x-jet-button>

            <video id="echo" playsinline autoplay class="mx-auto px-4 mt-2" height="640" width="480"></video>
        </div>
    </x-slot>

    <x-slot name="footer">
    </x-slot>

</x-jet-dialog-modal>
