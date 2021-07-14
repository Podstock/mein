<?php

namespace App\Http\Livewire\Camping;

use App\Models\Tent as ModelsTent;
use Livewire\Component;

class Tent extends Component
{
    public $tents;
    public $mytent;

    public function refresh()
    {        
        $this->mytent = auth()->user()->tent;
        if (empty($this->mytent))
            $this->tents = ModelsTent::whereNull('user_id')->whereVisible(true)->get();
    }

    public function mount()
    {
            $this->refresh();
    }

    public function select($tent_id)
    {
        $tent = ModelsTent::find($tent_id);
        if (empty($tent->user_id)) {
            $tent->user_id = auth()->user()->id;
            $tent->save();
        }

        $this->refresh();
    }

    public function delete()
    {
        $this->mytent->user_id = null;
        $this->mytent->save();
        $this->refresh();
    }

    public function render()
    {
        return view('livewire.camping.tent');
    }
}
