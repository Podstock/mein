<div class="p-8">
    <h2 class="text-xl mb-2">Mein Zelt</h2>

    @if($mytent)
    <div class="mx-auto md:w-1/2 lg:w-1/3">
        <div class="">
            <div
                class="relative rounded-lg border border-gray-300 bg-white px-6 py-5 shadow-sm flex items-center space-x-3 hover:border-gray-400 focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-indigo-500">
                <div class="flex-shrink-0">
                    <img height="85" width="64" src="/storage/{{$mytent->image}}" alt="">
                </div>
                <div class="flex-1 min-w-0">
                    <span class="absolute inset-0" aria-hidden="true"></span>
                    <p class="text-sm font-medium text-gray-900">
                        {!! Str::markdown($mytent->description) !!}
                    </p>
                </div>
            </div>
        </div>
        <div class="text-center mt-2">
            <button wire:click="delete" type="button"
                class="mt-2 inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-red-700 hover:bg-red-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500">
                Neues Zelt wählen
            </button>
        </div>
    </div>
    @else
    <h3 class="text-lg mb-2">Wähle ein freies Zelt</h3>
    <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4">
        @foreach($tents as $tent)

        <div wire:click="select({{$tent->id}})" wire:key="{{ $tent->id }}"
            class="cursor-pointer relative rounded-lg border border-gray-300 bg-white px-6 py-5 shadow-sm flex items-center space-x-3 hover:border-gray-400 focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-indigo-500">
            <div class="flex-shrink-0">
                <img height="64px" width="48px" src="/storage/{{$tent->image}}" alt="">
            </div>
            <div class="flex-1 min-w-0">
                <span class="absolute inset-0" aria-hidden="true"></span>
                <p class="text-sm font-medium text-gray-900">
                    {!! Str::markdown($tent->description) !!}
                </p>
            </div>
        </div>
        @endforeach
    </div>
    @endif
</div>
