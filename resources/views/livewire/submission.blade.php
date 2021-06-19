<div class="max-w-7xl mx-auto sm:px-6 lg:px-8 py-8">
    <div class="md:grid md:grid-cols-3 md:gap-6">
        <div class="md:col-span-1">
            <div class="px-4 sm:px-0">
                <h3 class="text-lg font-medium leading-6 text-gray-900">Einreichung</h3>
                <p class="mt-1 text-sm text-gray-600">
                    "Podstock ist, was Du daraus machst!"
                </p>
            </div>
        </div>
        <div class="mt-5 md:mt-0 md:col-span-2">
            <form wire:submit.prevent="submit">
                <div class="shadow sm:rounded-md sm:overflow-hidden">
                    <div class="px-4 py-5 bg-white space-y-6 sm:p-6">
                        <!-- Name -->
                        <div class="col-span-6 sm:col-span-4">
                            <x-jet-label for="talk.name" value="{{ __('Name im Programm') }}" />
                            <x-jet-input wire:model.defer="talk.name" id="talk.name" type="text"
                                class="mt-1 block w-full" />
                            <x-jet-input-error for="talk.name" class="mt-2" />
                        </div>
                        <!-- Art -->
                        <div>
                            <label for="talk.type"
                                class="block text-sm font-medium text-gray-700">Einreichungsart</label>
                            <select wire:model.defer="talk.type" id="talk.type" name="talk.type"
                                class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-green-500 focus:border-green-500 sm:text-sm rounded-md">
                                @foreach ($talk->getTypes() as $key => $value)
                                <option value="{{$key}}">{{$value}}</option>
                                @endforeach
                            </select>
                            <x-jet-input-error for="talk.type" class="mt-2" />
                        </div>
                        <!-- Recording -->
                        <div class="col-span-6 sm:col-span-4">
                            <x-jet-label for="talk.record" value="{{ __('Darf aufgezeichnet werden') }}" />
                            <x-jet-checkbox id="talk.record" wire:model.defer="talk.record" />
                            <x-jet-input-error for="talk.record" class="mt-2" />
                        </div>
                        <!-- Zeitpunkt -->
                        <div>
                            <label for="talk.wishtime" class="block text-sm font-medium text-gray-700">Gewünschter
                                Zeitpunkt</label>
                            <select wire:model.defer="talk.wishtime" id="talk.wishtime" name="talk.wishtime"
                                class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-green-500 focus:border-green-500 sm:text-sm rounded-md">
                                @foreach ($talk->getWishtimes() as $key => $value)
                                <option value="{{$key}}">{{$value}}</option>
                                @endforeach
                            </select>
                            <x-jet-input-error for="talk.wishtime" class="mt-2" />
                            <span class="text-xs">Der genaue Zeitpunkt wird noch festgelegt und ein Slot ist auf 45
                                Minuten begrenzt.</span>
                        </div>
                        <!-- Description -->
                        <div class="col-span-6 sm:col-span-4">
                            <x-jet-label for="talk.description"
                                value="{{ __('Beschreibung - öffentlich sichtbar') }}" />
                            <div class="mt-1">
                                <textarea wire:model.defer="talk.description" id="talk.description"
                                    name="talk.description" rows="3" maxlength="1000"
                                    class="shadow-sm focus:ring-green-500 focus:border-green-500 block w-full sm:text-sm border border-gray-300 rounded-md"></textarea>
                            </div>
                            <x-jet-input-error for="talk.description" class="mt-2" />
                        </div>

                        <!-- Kommentar -->
                        <div class="col-span-6 sm:col-span-4">
                            <x-jet-label for="talk.comment"
                                value="{{ __('Anmerkungen - nur für die Podstock Orga') }}" />
                            <div class="mt-1">
                                <textarea wire:model.defer="talk.comment" id="talk.comment" name="talk.comment" rows="3"
                                    maxlength="1000"
                                    class="shadow-sm focus:ring-green-500 focus:border-green-500 block w-full sm:text-sm border border-gray-300 rounded-md"></textarea>
                            </div>
                            <x-jet-input-error for="talk.comment" class="mt-2" />
                        </div>

                        <!-- Logo -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700">
                                Logo
                            </label>
                            <div class="mt-1 flex items-center space-x-5">
                                <span class="inline-block h-12 w-12 rounded-full overflow-hidden bg-gray-100">
                                    <svg class="h-full w-full text-gray-300" fill="currentColor" viewBox="0 0 24 24">
                                        <path
                                            d="M24 20.993V24H0v-2.996A14.977 14.977 0 0112.004 15c4.904 0 9.26 2.354 11.996 5.993zM16.002 8.999a4 4 0 11-8 0 4 4 0 018 0z" />
                                    </svg>
                                </span>
                                <button type="button"
                                    class="bg-white py-2 px-3 border border-gray-300 rounded-md shadow-sm text-sm leading-4 font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                                    Logo hochladen
                                </button>
                            </div>
                        </div>
                    </div>
                    @if($talk->id)
                    <div class="px-4 py-3 bg-gray-50 text-left sm:px-6">
                    </div>
                    @endif
                    @if($talk->id)
                    <div class="flex justify-between px-4 py-3 bg-gray-50 sm:px-6">
                        <button wire:click="delete"
                            class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-red-700 hover:bg-red-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                           Löschen 
                        </button>
                        <button type="submit"
                            class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-green-700 hover:bg-green-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                            Speichern
                        </button>
                    </div>
                    @else
                    <div class="text-right px-4 py-3 bg-gray-50 sm:px-6">
                        <button type="submit"
                            class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-green-700 hover:bg-green-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                            Jetzt Einreichen
                        </button>
                    </div>
                    @endif
                </div>
            </form>
        </div>
    </div>


</div>
