<?php

namespace App\Http\Livewire\Room;

use App\Models\Room;
use Livewire\Component;

class Index extends Component
{
    public $room;
    public $launch;

    public function mount(Room $room)
    {
        $this->room = $room;
        $this->launch = false;
    }

    public function render()
    {
        return view('livewire.room.index')->layout('layouts.empty');
    }
}
