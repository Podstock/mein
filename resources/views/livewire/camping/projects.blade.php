<div class="p-8">
    <h2 class="text-xl mb-2">Projekte</h2>
    <h3 class="text-lg mb-2">Hier kannst du deine Projekte eintragen</h3>
    @foreach ($projects as $project)
    <livewire:camping.project :wire:key="$project->id" :project="$project" />
    @endforeach

    <div class="text-center border-t-2 mt-8 pt-4">
        <button wire:click="new" type="button"
            class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-gray-500 hover:bg-gray-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500">
            Neues Projekt anlegen
        </button>
        @if (session()->has('error'))
        <div class="mt-3 text-red-800">
            {{ session('error') }}
        </div>
        @endif
    </div>
</div>
