<?php

namespace App\Http\Livewire\Camping;

use App\Models\Project;
use Livewire\Component;

class Projects extends Component
{
    public $projects;

    protected $listeners = ['projectDeleted' => 'refresh'];

    public function mount()
    {
        $this->refresh();
    }

    public function refresh()
    {
        $this->projects = auth()->user()->projects()->get();
    }

    public function new()
    {
        foreach($this->projects as $project)
        {
            if(empty($project->name)) {
                session()->flash('error', 'Bitte erst das vorhandene Projekt ausfüllen...');

                return;
            }
        }
        $project = Project::make();
        $project->user_id = auth()->user()->id;
        $project->save();
        $this->refresh();
    }

    public function render()
    {
        return view('livewire.camping.projects');
    }
}
