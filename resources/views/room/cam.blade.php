<x-jet-dialog-modal wire:model="modal_cam">

    <x-slot name="title">
        <div class="text-center">Kamera wählen/testen</div>
    </x-slot>
    <x-slot name="content">
        <div x-data x-intersect="$store.webrtc_video.setup()"
            x-init="$watch('$store.webrtc_video.input_id', () => $store.webrtc_video.input_changed())">
            <label for="cam" class="text-left block text-sm font-bold text-gray-700">Kamera</label>
            <select x-model="$store.webrtc_video.input_id" id="cam" name="cam"
                class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-green-700 focus:border-green-700 sm:text-sm  rounded-md">
                <template x-for="cam in $store.webrtc_video.inputs">
                    <option x-text="cam.value" :value="cam.key"></option>
                </template>
            </select>

            <video id="echo" playsinline autoplay class="mx-auto px-4 mt-2" height="640" width="480"></video>
        </div>
    </x-slot>

    <x-slot name="footer">
        <x-jet-button @click="$store.webrtc_video.echo_ready()">Übernehmen</x-jet-button>
    </x-slot>

</x-jet-dialog-modal>
