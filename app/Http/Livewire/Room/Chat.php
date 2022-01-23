<?php

namespace App\Http\Livewire\Room;

use App\Events\MessageAdded;
use App\Models\Room;
use Livewire\Component;

class Chat extends Component
{
    public $show;
    public $room_messages;
    public $room;
    public $body;

    protected $rules = [
        'body' => 'required|string',
    ];

    protected function getListeners()
    {
        return [
            'toggleChat',
        ];
    }

    public function mount(Room $room)
    {
        $this->show = false;
        $this->room = $room;
        $this->room_messages = $room->messages()->limit(100)
            ->with(['user'])->get();
    }

    public function toggleChat()
    {
        $this->show = !$this->show;
    }

    public function send()
    {
        $this->validate();
        $message = $this->room->messages()->create([
            'body' => $this->body,
            'user_id' => auth()->user()->id
        ]);

        $message->load('user');
        MessageAdded::dispatch($this->room, $message);

        $this->body = '';
    }

    public function render()
    {
        return view('livewire.room.chat');
    }
}
