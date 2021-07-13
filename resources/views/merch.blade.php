<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Festival Merch/Sticker') }}
        </h2>
    </x-slot>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-gray-700">
        <div class="py-6 space-y-6">
            <div>
                <h2 class="text-2xl mb-2">Sticker/Aufkleber einsenden</h2>
                <div class="max-w-7xl px-6 pb-6 bg-white shadow-md overflow-hidden rounded-lg prose">
                    <div class="text-center font-bold">
                    <p class="text-lg">Bis zum 31.07.2021 kannst du uns <br />unter folgender Adresse Sticker schicken:</p>
                        Ralph Meyer<br />
                        Postnummer 34144422<br />
                        Packstation 103<br />
                        74172 Neckarsulm<br />
                                            <a href="https://www.deutschepost.de/de/b/briefe-adressieren-an-packstation.html"
                        target="_blank">Versandbedingungen
                        der Post</a>
                       <p>Kalkuliere am besten mit einer Menge zwischen 50 und max. 300 Stickern. <br />Bitte keine Buttons oder anderer Merch.</p>
                    </div>
                    
                </div>
            </div>

            <div>
                <h2 class="text-2xl mb-2">Sticker Paket bestellen</h2>
                <div class="max-w-7xl p-6 bg-white shadow-md overflow-hidden rounded-lg prose">
                    @php
                    echo Str::markdown("
Demnächst kannst du hier dein Festival Sticker Paket bestellen. Enthalten sein wird:
- Das Podstock 2021 Festivalbändchen
- mind. 2x Podstock Sticker
- Eine Mischung aus allen bis dahin eingesendeten Stickern


Preis: **5 Euro** inkl. 19% MwSt.

                    ");
                    @endphp
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
