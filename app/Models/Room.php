<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class Room extends Model
{
    use HasFactory;

    const GUEST = 0;
    const SPEAKER = 10;
    const MODERATOR = 20;
    const OWNER = 30;
    const ADMIN = 99;

    public static function getRole($key = null)
    {
        $options = [
            self::GUEST => 'User',
            self::SPEAKER => 'SpeakerIn',
            self::MODERATOR => 'ModeratorIn',
            self::OWNER => 'Owner',
            self::ADMIN => 'Admin',
        ];

        if ($key !== null) {
            return $options[$key];
        }

        return $options;
    }

    public function messages()
    {
        return $this->hasMany(Message::class);
    }

    public function users()
    {
        return $this->belongsToMany(User::class)->withPivot('role');
    }

    public function baresip()
    {
        return $this->hasOne(Baresip::class);
    }

    public function is_user_online()
    {
        return Cache::get('online-' . $this->slug . '-' . auth()->user()->id, false);
    }

    public function user_online()
    {
        Cache::put('online-' . $this->slug . '-' . auth()->user()->id, true);
    }

    public function user_offline()
    {
        Cache::forget('online-' . $this->slug . '-' . auth()->user()->id);
    }

    public function set_video_available($value)
    {
        return Cache::put('room-video-' . $this->slug, $value);
    }

    public function video_available()
    {
        return Cache::get('room-video-' . $this->slug, false);
    }
}
