<?php

namespace App\Http\Livewire\Room;

use App\Models\Room;
use Livewire\Component;

class Stream extends Component
{
    public Room $room;

    public function mount(Room $room)
    {
        $this->room = $room;
    }

    public function render()
    {
        return view('livewire.room.stream');
    }
}
