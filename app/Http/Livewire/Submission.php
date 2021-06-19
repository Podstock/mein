<?php

namespace App\Http\Livewire;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

use App\Models\Talk;
use App\Rules\TalkType;
use App\Rules\TalkWishtime;
use Livewire\Component;

class Submission extends Component
{
    use AuthorizesRequests;
    public Talk $talk;

    protected function rules()
    {
        return [
            'talk.name' => 'required|string',
            'talk.type' => ['required', new TalkType],
            'talk.wishtime' => ['required', new TalkWishtime],
            'talk.description' => 'required|min:25|string',
            'talk.comment' => 'nullable|string',
            'talk.record' => 'required|boolean'
        ];
    }

    public function mount(Talk $talk)
    {
        $this->talk = $talk;
        $this->talk->type = Talk::TYPE_LIVESTREAM;
        $this->talk->wishtime = Talk::WISHTIME_DAY2_1;
        $this->talk->record = true;
    }

    public function submit()
    {
        if ($this->talk->id)
            $this->authorize('update', $this->talk);
        else
            $this->authorize('create', Talk::class);

        $this->validate();

        $this->talk->user_id = auth()->user()->id;
        $this->talk->save();

        return redirect()->to(route('mytalks'));
    }

    public function render()
    {
        return view('livewire.submission');
    }
}
