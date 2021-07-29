<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
}