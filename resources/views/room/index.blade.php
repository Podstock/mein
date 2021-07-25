<x-app-layout>
    <audio id="audio" autoplay></audio>
    <div class="flex">
        <main class="w-full">
            @include('room.users')
        </main>
        <livewire:room.chat :room="$room" />
    </div>
    <livewire:room.actions :room="$room" />
</x-app-layout>
