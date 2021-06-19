<?php

namespace App\Http\Livewire;

use Livewire\Component;

class Mytalks extends Component
{
    public $talks;

    public function mount()
    {
        $this->talks = auth()->user()->talks;
    }

    public function render()
    {
        return view('livewire.mytalks');
    }
}
