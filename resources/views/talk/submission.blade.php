<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Call for Podcasts') }}
        </h2>
    </x-slot>
    @include('talk.nav')
    <livewire:submission />
</x-app-layout>
