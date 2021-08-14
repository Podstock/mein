<?php

namespace App\Http\Livewire;

use App\Models\Schedule as ModelsSchedule;
use Livewire\Component;

class Schedule extends Component
{
    public $schedules;
    public $day = 2;
    protected $queryString = ['day'];

    public function render()
    {
        $this->schedules = ModelsSchedule::with(['talk', 'room', 'talk.user'])
            ->where(['day' => 'day' . $this->day])
            ->get()->sortBy('time');

        if (auth()->user())
            return view('livewire.schedule');

        return view('livewire.schedule')->layout('layouts.guest');
    }
}
