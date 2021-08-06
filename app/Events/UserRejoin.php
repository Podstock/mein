<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class UserRejoin implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $roomSlug;
    public $userId;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($roomSlug, $user_id = null)
    {
        if (empty($user_id))
            $user_id = auth()->user()->id;
        $this->userId = $user_id;
        $this->roomSlug = $roomSlug;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PresenceChannel('users.' . $this->roomSlug);
    }
}
