<?php

namespace App\Http\Livewire\Room;

use App\Models\Room;
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
    }

    public function mount(Room $room)
    {
        $this->room = $room;
        $this->connect = false;
        $this->echo = false;
        $this->webrtc = false;
    }

    public function render()
    {
        return view('livewire.room.index')->layout('layouts.empty');
    }
}
