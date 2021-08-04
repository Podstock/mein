<?php

namespace App\Http\Livewire\Room;

use App\Models\Room;
use Livewire\Component;

class Index extends Component
{
    public $room;
    public $connect;
    public $echo;
    public $status;

    const STATUS_OFFLINE = 0;
    const STATUS_STREAM_AUDIO = 10;
    const STATUS_STREAM_VIDEO = 20;
    const STATUS_WEBRTC_ECHO = 30;
    const STATUS_WEBRTC_OFFER = 40;
    const STATUS_WEBRTC_CONNECTED = 50;

    protected function getListeners()
    {
        return [
            'toggleListen',
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

    public function mount(Room $room)
    {
        $this->room = $room;
        $this->connect = false;
        $this->echo = true;
        $this->status = $this::STATUS_OFFLINE;
    }

    public function render()
    {
        return view('livewire.room.index')->layout('layouts.empty');
    }
}
