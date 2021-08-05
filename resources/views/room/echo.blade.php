<x-jet-dialog-modal wire:model="echo">

    <x-slot name="title">
        <div class="text-center">Teste deine Verbindung</div>
    </x-slot>
    <x-slot name="content">
        <div x-data x-intersect.once="$store.webrtc.setup()"
            x-init="$watch('$store.webrtc.audio_input_id', () => $store.webrtc.audio_input_changed()); $watch('$store.webrtc.audio_output_id', () => $store.webrtc.audio_output_changed());"
            class="w-2/3 mx-auto">
            <label for="microphone" class="text-left block text-sm font-bold text-gray-700">Microphone</label>
            <select x-show="$store.webrtc.audio_input_id" x-model="$store.webrtc.audio_input_id" id="microphone"
                name="microphone"
                class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-green-700 focus:border-green-700 sm:text-sm  rounded-md">
                <template x-for="micro in $store.webrtc.audio_inputs">
                    <option x-text="micro.value" :value="micro.key"></option>
                </template>
            </select>
            <div x-show="$store.webrtc.audio_output_id">
                <label for="speaker" class="text-left block text-sm font-bold text-gray-700 mt-3">Speaker</label>
                <select x-model="$store.webrtc.audio_output_id" id="speaker" name="speaker"
                    class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-green-700 focus:border-green-700 sm:text-sm  rounded-md">
                    <template x-for="speaker in $store.webrtc.audio_outputs">
                        <option x-text="speaker.value" :value="speaker.key"></option>
                    </template>
                </select>
            </div>

            <div x-show="$store.webrtc.echo_failed" class="text-red-600 mt-2">
                Bitte überprüfe ob du das richtige Mikrofon und Headset ausgewählt hast
                und starte den Test erneut...

            </div>
            <div x-show="!$store.webrtc.echo" class="pt-5">
                <div class="flex justify-end">
                    <button @click="$store.webrtc.echo_connect()" type="submit"
                        class="ml-3 inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-green-700 hover:bg-green-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-700">
                        Start Echo Test
                    </button>
                </div>
            </div>

            <div x-show="$store.webrtc.echo" class="pt-5">
                <div class="mb-2">
                    Hörst du deine eigene Stimme?
                </div>
                <div class="flex justify-start">
                    <button @click="$store.webrtc.echo_yes()" type="submit"
                        class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-green-700 hover:bg-green-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-700">
                        Ja
                    </button>
                    <button @click="$store.webrtc.echo_no()" type="submit"
                        class="ml-3 inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-red-700 hover:bg-red-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-700">
                        Nein
                    </button>
                </div>
            </div>
        </div>
        </div>

    </x-slot>

    <x-slot name="footer">
    </x-slot>

</x-jet-dialog-modal>
