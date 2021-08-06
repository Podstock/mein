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
    public $handVisible;
    public $room_slug;

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
            RaiseHand::dispatch($this->room_slug);
        else
            UnraiseHand::dispatch($this->room_slug);
    }

    public function mount(Room $room)
    {
        $this->chat = false;
        $this->play = false;
        $this->hand = false;
        $this->handVisible = true;
        $this->room_slug = $room->slug;
    }

    public function render()
    {
        return view('livewire.room.actions');
    }
}
