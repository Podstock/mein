<?php

namespace App\Http\Livewire;

use App\Models\Talk;
use Livewire\Component;

class Mytalks extends Component
{
    public $talks;

    public function mount()
    {
        $this->talks = auth()->user()->talks;
    }

    public function confirm(Talk $talk)
    {
        if (auth()->user()->id != $talk->user_id)
            abort(403);

        $talk->status = Talk::STATUS_CONFIRMED;
        $talk->save();
        $this->talks = auth()->user()->talks;
    }

    public function render()
    {
        return view('livewire.mytalks');
    }
}
