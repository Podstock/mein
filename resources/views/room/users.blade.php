<div x-data="users" x-init="listen('{{$room->slug}}')" @rejoin.window="rejoin($event.detail.msg)">
@include('room.speakers')
@include('room.listeners')
</div>
