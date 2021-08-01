<?php

use App\Models\Room;
use Illuminate\Support\Facades\Broadcast;

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

Broadcast::channel('users.{room}', function ($user, Room $room) {
    if (!empty($user->id)) {
        return [
            'id' => $user->id,
            'name' => $user->name,
            'nickname' => $user->nickname,
            'image' => $user->ProfilePhotoUrl,
            'hand' => false,
            'type' => $user->is_speaker($room->id) ? 'speaker' : 'listener'
        ];
    }
});

Broadcast::channel('webrtc.sdp.{id}', function ($user, $id) {
    return (int) $user->id === (int) $id;
});
