<div>
    <div class="flex">
        <main class="w-full">
            @include('room.users')
        </main>
        <livewire:room.chat :room="$room" />
    </div>
    <livewire:room.actions :room="$room" />

    <div>
    <audio id="audio" autoplay></audio>
    @include('room.connect')
    @include('room.echo')
    </div>

    <script>
        window.room_slug = "{{$room->slug}}";
    </script>
</div>
