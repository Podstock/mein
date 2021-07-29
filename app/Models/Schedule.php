<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    use HasFactory;

    const DAY1 = 'day1';
    const DAY2 = 'day2';
    const DAY3 = 'day3';

    public static function getDay($key = null)
    {
        $options = [
            self::DAY1 => 'Fr 13.08.',
            self::DAY2 => 'Sa 14.08.',
            self::DAY3 => 'So 15.08.',
        ];

        if ($key !== null) {
            return $options[$key];
        }

        return $options;
    }


    public function room()
    {
        return $this->belongsTo(Room::class);
    }

    public function talk()
    {
        return $this->belongsTo(Talk::class);
    }
}
