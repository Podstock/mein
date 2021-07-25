<div x-data="users" x-init="listen({{$room->id}})">
@include('room.speakers')
@include('room.listeners')
</div>
