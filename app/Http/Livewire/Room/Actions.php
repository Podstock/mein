<?php

namespace App\Http\Livewire\Room;

use App\Models\Room;
use App\Events\RaiseHand;
use App\Events\UnraiseHand;
use Livewire\Component;

class Actions extends Component
{
    public $chat;
    public $play;
    public $hand;
    public $roomId;

    protected function getListeners()
    {
        return [
            'toggleChat',
        ];
    }

    public function toggleChat()
    {
        $this->chat = !$this->chat;
    }

    public function raiseHand()
    {
        $this->hand = !$this->hand;
        if ($this->hand)
            RaiseHand::dispatch($this->roomId);
        else
            UnraiseHand::dispatch($this->roomId);
    }

    public function mount(Room $room)
    {
        $this->chat = false;
        $this->play = false;
        $this->hand = false;
        $this->roomId = $room->id;
    }

    public function render()
    {
        return view('livewire.room.actions');
    }
}
