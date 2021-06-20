<?php

namespace App\Http\Livewire;

use App\Facades\Image;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

use App\Models\Talk;
use App\Rules\TalkType;
use App\Rules\TalkWishtime;
use Livewire\Component;
use Livewire\WithFileUploads;

class Submission extends Component
{
    use AuthorizesRequests;
    use WithFileUploads;
    public Talk $talk;
    public $logo;
    public $logo_validated;

    protected function rules()
    {
        return [
            'talk.name' => 'required|string',
            'talk.type' => ['required', new TalkType],
            'talk.wishtime' => ['required', new TalkWishtime],
            'talk.description' => 'required|min:25|string',
            'talk.comment' => 'nullable|string',
            'talk.record' => 'required|boolean',
        ];
    }

    public function mount(Talk $talk)
    {
        $this->talk = $talk;
        if (!$this->talk->id) {
            $this->talk->type = Talk::TYPE_LIVESTREAM;
            $this->talk->wishtime = Talk::WISHTIME_DAY2_1;
            $this->talk->record = true;
        } else {
            $this->authorize('view', $this->talk);
        }
        $this->logo_validated = false;
    }

    public function updatedLogo()
    {
        $this->logo_validated = false;
        $this->validate([
            'logo' => 'image|mimes:jpg,png,jpeg,gif|max:5120', // 5MB Max
        ]);

        $this->logo_validated = true;
    }

    public function delete()
    {
        $this->authorize('delete', $this->talk);
        $this->talk->delete();
        return redirect()->to(route('mytalks'));
    }

    public function submit()
    {
        if ($this->talk->id)
            $this->authorize('update', $this->talk);
        else
            $this->authorize('create', Talk::class);

        $this->validate();

        if (isset($this->logo)) {
            $path = $this->logo->store('logos', 'public');
            Image::resize_copy(storage_path('app/public/' . $path), storage_path('app/public/medium/' . $path), 512);
            Image::resize_copy(storage_path('app/public/' . $path), storage_path('app/public/small/' . $path), 256);
            Image::resize_copy(storage_path('app/public/' . $path), storage_path('app/public/tiny/' . $path), 128);
            $this->talk->logo = $path;
        }

        $this->talk->user_id = auth()->user()->id;
        $this->talk->save();

        return redirect()->to(route('mytalks'));
    }

    public function render()
    {
        return view('livewire.submission');
    }
}
