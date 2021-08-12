<?php

namespace App\Events;

use App\Models\Baresip;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class WebrtcTalk implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $room_slug;
    public $userId;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($baresip_id, $user_id)
    {
        $baresip = Baresip::find($baresip_id);
        $this->room_slug = $baresip?->room?->slug;
        $this->userId = $user_id;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PresenceChannel('users.' . $this->room_slug);
    }
}
