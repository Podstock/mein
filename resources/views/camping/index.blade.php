<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Zelten') }}
        </h2>
    </x-slot>
    <livewire:camping.projects />
    <livewire:camping.tent />
</x-app-layout>
