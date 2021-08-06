<x-jet-dialog-modal wire:model="modal_user">

    <x-slot name="title">
        <div class="text-center">{{$user?->name}} {{'@'.$user?->nickname}}</div>
    </x-slot>
    <x-slot name="content">
        <div class="flex flex-col text-center">
            <img class="mx-auto h-16 w-16 rounded-full lg:w-20 lg:h-20 mb-4" src="{{$user?->ProfilePhotoUrl}}" alt="" />

            @if($user?->is_moderator($room->id))
            @if($user?->is_speaker($room->id))
            <button wire:click="makeListener()" type="button"
                class="ml-3 inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-gray-700 hover:bg-green-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-700">
                Zurück ins Publikum</button>
            @else
            <button wire:click="makeSpeaker()" type="button"
                class="ml-3 mb-2 inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-green-700 hover:bg-gray-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-700">
                Auf die Bühne holen</button>
            @endif
            @endif
        </div>
    </x-slot>

    <x-slot name="footer">
    </x-slot>

</x-jet-dialog-modal>
