<div class="shadow sm:rounded-md sm:overflow-hidden mb-4">
    <div class="px-4 py-5 bg-white space-y-6 sm:p-6">
        <form wire:submit.prevent="save" class="space-y-4">
            <!-- Name -->
            <div class="col-span-6 sm:col-span-4">
                <x-jet-label for="project.name" value="{{ __('Projekt Name') }}" />
                <x-jet-input wire:model.defer="project.name" id="project.name" placeholder="Podcast xyz" type="text" class="mt-1 block w-full" />
                <x-jet-input-error for="project.name" class="mt-2" />
            </div>
            <!-- Url -->
            <div class="col-span-6 sm:col-span-4">
                <x-jet-label for="project.url" value="{{ __('Projekt url') }}" />
                <x-jet-input wire:model.defer="project.url" id="project.url" placeholder="https://mein.podcast.de" type="text" class="mt-1 block w-full" />
                <x-jet-input-error for="project.url" class="mt-2" />
            </div>

            <!-- Logo -->
            <div>
                <label class="block text-sm font-medium text-gray-700">
                    Logo
                </label>
                <div class="mt-1 flex items-center space-x-5">
                    <span class="inline-block h-20 w-20 rounded-full overflow-hidden bg-gray-100">
                        @if($logo_validated)
                        <img class="h-20 w-20" src="{{ $logo->temporaryUrl() }}">
                        @else
                        @if($project->logo)
                        <img class="h-20 w-20" src="/storage/small/{{ $project->logo }}">
                        @else
                        <svg class="h-full w-full text-gray-300" fill="currentColor" viewBox="0 0 24 24">
                            <path
                                d="M24 20.993V24H0v-2.996A14.977 14.977 0 0112.004 15c4.904 0 9.26 2.354 11.996 5.993zM16.002 8.999a4 4 0 11-8 0 4 4 0 018 0z" />
                        </svg>
                        @endif
                        @endif
                    </span>
                    <input type="file" wire:model="logo">
                    <div class="flex" wire:loading wire:target="logo">
                        <svg class="animate-spin -ml-1 mr-3 h-5 w-5 text-green-700" xmlns="http://www.w3.org/2000/svg"
                            fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4">
                            </circle>
                            <path class="opacity-75" fill="currentColor"
                                d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
                            </path>
                        </svg>
                        <div>
                            Uploading...
                        </div>
                    </div>
                    @error('logo') <span class="text-red-600">{{ $message }}</span> @enderror
                </div>
            </div>
            <!-- Actions -->
            <div class="flex justify-between mt-4">
                <div class="flex items-center">
                    <button type="submit" wire:loading.attr="disabled" wire:target="logo"
                        class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-green-700 hover:bg-green-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                        Speichern
                    </button>
                    @if (session()->has('saved'))
                    <div class="ml-2 text-green-800" x-effect="setTimeout(() => { $el.classList.add('hidden') }, 1500)">
                        Gespeichert
                    </div>
                    @endif
                </div>
                <button type="button" wire:click="delete"
                    onclick="confirm('Wirklich löschen?') || event.stopImmediatePropagation()"
                    class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-red-700 hover:bg-red-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                    Löschen
                </button>
            </div>
        </form>
    </div>
</div>
