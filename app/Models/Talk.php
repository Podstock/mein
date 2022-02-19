<?php

namespace App\Models;

use App\Notifications\TalkAccepted;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Talk extends Model
{
    use HasFactory;

    protected $casts = [
        'user_id' => 'integer',
        'record' => 'boolean',
        'status' => 'integer'
    ];

    const STATUS_SUBMITTED = 0;
    const STATUS_ACCEPTED = 10;
    const STATUS_CONFIRMED = 20;

    const TYPE_LIVESTREAM = 1;
    const TYPE_WORKSHOP = 2;
    const TYPE_RECORDING_AUDIO = 3;
    const TYPE_RECORDING_VIDEO = 4;
    const TYPE_LIVESTREAM_VIDEO = 5;

    const WISHTIME_DAY1_1 = 10;
    const WISHTIME_DAY1_2 = 20;
    const WISHTIME_DAY1_3 = 30;
    const WISHTIME_DAY2_1 = 40;
    const WISHTIME_DAY2_2 = 50;
    const WISHTIME_DAY2_3 = 60;
    const WISHTIME_DAY3_1 = 70;
    const WISHTIME_DAY3_2 = 80;
    const WISHTIME_DAY3_3 = 90;

    protected static function booted()
    {
        static::updated(function ($talk) {
            if (
                $talk->status === self::STATUS_ACCEPTED &&
                (int)$talk->getOriginal('status') === self::STATUS_SUBMITTED
            ) {
                $talk->user->notify(new TalkAccepted($talk));
            }
        });
    }


    public static function getTypes($key = null)
    {
        $options = [
            self::TYPE_LIVESTREAM => 'Session', 
            /* self::TYPE_LIVESTREAM_VIDEO => 'Livestream - Video', */
            /* self::TYPE_WORKSHOP => 'Workshop Audio/Video', */
            /* self::TYPE_RECORDING_AUDIO => 'Aufzeichnung - Audio', */
            /* self::TYPE_RECORDING_VIDEO => 'Aufzeichnung - Video', */
        ];

        if ($key !== null) {
            return $options[$key];
        }

        return $options;
    }

    public static function getWishtimes($key = null)
    {
        $options = [
            self::WISHTIME_DAY2_1 => 'Sa 19.02.',
            self::WISHTIME_DAY3_1 => 'So 20.02.',
        ];

        if ($key !== null) {
            return $options[$key];
        }

        return $options;
    }

    public static function getStatus($key = null)
    {
        $options = [
            self::STATUS_SUBMITTED => 'Eingereicht',
            self::STATUS_ACCEPTED => 'Angenommen',
            self::STATUS_CONFIRMED => 'Bestätigt',
        ];

        if ($key !== null) {
            return $options[$key];
        }

        return $options;
    }

    public function getTypeNameAttribute()
    {
        return $this->getTypes($this->type);
    }

    public function user()
    {
        return $this->belongsTo(\App\Models\User::class);
    }

    public function schedule()
    {
        return $this->hasOne(Schedule::class);
    }
}
