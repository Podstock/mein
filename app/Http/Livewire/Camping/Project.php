<?php

namespace App\Http\Livewire\Camping;

use App\Facades\Image;
use App\Models\Project as ModelsProject;
use Livewire\Component;
use Livewire\WithFileUploads;

class Project extends Component
{
    use WithFileUploads;

    public ModelsProject $project;
    public $logo;
    public $logo_validated;

    protected function rules()
    {
        return [
            'project.name' => 'required|string',
            'project.url' => 'required|url',
        ];
    }

    public function updatedLogo()
    {
        $this->logo_validated = false;
        $this->validate([
            'logo' => 'image|mimes:jpg,png,jpeg,gif|max:5120', // 5MB Max
        ]);

        $this->logo_validated = true;
    }

    public function save()
    {
        $this->validate();

        if ($this->logo_validated && isset($this->logo)) {
            $path = $this->logo->store('logos', 'public');
            Image::resize_copy(storage_path('app/public/' . $path), storage_path('app/public/medium/' . $path), 512);
            Image::resize_copy(storage_path('app/public/' . $path), storage_path('app/public/small/' . $path), 256);
            Image::resize_copy(storage_path('app/public/' . $path), storage_path('app/public/tiny/' . $path), 128);
            $this->project->logo = $path;
        }

        $this->project->user_id = auth()->user()->id;
        $this->project->save();
        session()->flash('saved');
    }

    public function delete()
    {
        $this->project->delete();
        $this->emit('projectDeleted');
    }

    public function render()
    {
        return view('livewire.camping.project');
    }
}
