<?php

namespace App\Http\Livewire\Room;

use App\Events\UserRejoin;
use App\Models\BaresipWebrtc;
use App\Models\Room;
use App\Models\User;
use Illuminate\Support\Facades\Cache;
use Livewire\Component;

class Index extends Component
{
    public $room;
    public $connect;
    public $echo;
    public $webrtc;
    public $modal_user;
    public $modal_options;
    public $modal_cam;
    public User $user;

    protected function getListeners()
    {
        return [
            'toggleListen',
            'toggleOptions',
            'toggleCam',
            'webrtcReady',
            'webrtcOffline',
            'modalUser'
        ];
    }

    public function modalUser(User $user)
    {
        $this->modal_user = $user->id;
        $this->user = $user;
    }

    public function toggleListen()
    {
        $this->connect = true;
    }

    public function toggleOptions()
    {
        $this->modal_options = true;
    }


    public function toggleCam()
    {
        $this->modal_options = false;
        $this->modal_cam = !$this->modal_cam;
    }


    public function webrtc()
    {
        $this->connect = false;
        $this->echo = true;
    }

    public function webrtcReady()
    {
        $this->echo = false;
        $this->webrtc = true;

        $this->room->user_online();
        BaresipWebrtc::update_audio($this->room->id, auth()->user());
        UserRejoin::dispatch($this->room->slug);
    }

    public function webrtcOffline()
    {
        $this->webrtc = false;
        $this->modal_options = false;

        if ($this->room->is_user_online()) {
            $this->room->user_offline();
            UserRejoin::dispatch($this->room->slug);
        }
    }

    public function makeListener()
    {
        $this->user->room_listener($this->room);
        $this->modal_user = false;
        UserRejoin::dispatch($this->room->slug, $this->user->id);
        BaresipWebrtc::update_audio($this->room->id, $this->user);
    }

    public function makeSpeaker()
    {
        $this->user->room_speaker($this->room);
        $this->modal_user = false;
        UserRejoin::dispatch($this->room->slug, $this->user->id);
        BaresipWebrtc::update_audio($this->room->id, $this->user);
    }

    public function mount(Room $room)
    {
        $this->room = $room;
        $this->connect = false;
        $this->echo = false;
        $this->webrtc = false;
        $this->modal_user = false;
        $this->modal_options = false;
        $this->modal_cam = true;
        Cache::put('online-' . $this->room->slug . '-' . auth()->user()->id, false);
        $this->room->user_offline();
    }

    public function render()
    {
        return view('livewire.room.index')->layout('layouts.empty');
    }
}
