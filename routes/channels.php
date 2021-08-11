<?php

use App\Models\Room;
use Illuminate\Support\Facades\Broadcast;
use Illuminate\Support\Facades\Cache;

/*
|--------------------------------------------------------------------------
| Broadcast Channels
|--------------------------------------------------------------------------
|
| Here you may register all of the event broadcasting channels that your
| application supports. The given channel authorization callbacks are
| used to check if an authenticated user can listen to the channel.
|
*/

Broadcast::channel('chat.{roomId}', function ($user) {
    //Allow every logged in user
    return !empty($user->id);
});

Broadcast::channel('users.{room_slug}', function ($user, $room_slug) {
    $room = Room::whereSlug($room_slug)->firstOrFail();
    if (!empty($user->id)) {
        return [
            'id' => $user->id,
            'name' => $user->name,
            'nickname' => $user->nickname,
            'image' => $user->ProfilePhotoUrl,
            'hand' => false,
            'connected' => $room->is_user_online(),
            'room_video' => $room->video(),
            'type' => $user->is_speaker($room->id) ? 'speaker' : 'listener'
        ];
    }
});

Broadcast::channel('webrtc.sdp.{id}', function ($user, $id) {
    return (int) $user->id === (int) $id;
});

Broadcast::channel('webrtc_video.sdp.{id}', function ($user, $id) {
    return (int) $user->id === (int) $id;
});

Broadcast::channel('webrtc_video.ready.{room_slug}', function ($user, $room_slug) {
    return !empty($user->id);
});
