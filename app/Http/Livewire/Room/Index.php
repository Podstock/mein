<?php

namespace App\Http\Livewire\Room;

use App\Events\UserRejoin;
use App\Models\Room;
use Illuminate\Support\Facades\Cache;
use Livewire\Component;

class Index extends Component
{
    public $room;
    public $connect;
    public $echo;
    public $webrtc;

    protected function getListeners()
    {
        return [
            'toggleListen',
            'webrtcReady',
            'webrtcOffline',
        ];
    }

    public function toggleListen()
    {
        $this->connect = true;
    }

    public function webrtc()
    {
        $this->connect = false;
        $this->echo = true;
    }

    public function webrtcReady()
    {
        $this->echo = false;
        $this->webrtc = true;

        $this->room->user_online();
        UserRejoin::dispatch($this->room->slug);
    }

    public function webrtcOffline()
    {
        $this->webrtc = false;

        if ($this->room->is_user_online()) {
            $this->room->user_offline();
            UserRejoin::dispatch($this->room->slug);
        }
    }

    public function mount(Room $room)
    {
        $this->room = $room;
        $this->connect = false;
        $this->echo = false;
        $this->webrtc = false;
        Cache::put('online-' . $this->room->slug . '-' . auth()->user()->id, false);
        $this->room->user_offline();
    }

    public function render()
    {
        return view('livewire.room.index')->layout('layouts.empty');
    }
}
