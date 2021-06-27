<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Talk extends Model
{
    use HasFactory;

    protected $casts = [
        'user_id' => 'integer',
        'record' => 'boolean',
    ];

    const TYPE_LIVESTREAM = 1;
    const TYPE_WORKSHOP = 2;
    const TYPE_RECORDING_AUDIO = 3;
    const TYPE_RECORDING_VIDEO = 4;

    const WISHTIME_DAY1_1 = 10;
    const WISHTIME_DAY1_2 = 20;
    const WISHTIME_DAY1_3 = 30;
    const WISHTIME_DAY2_1 = 40;
    const WISHTIME_DAY2_2 = 50;
    const WISHTIME_DAY2_3 = 60;
    const WISHTIME_DAY3_1 = 70;
    const WISHTIME_DAY3_2 = 80;
    const WISHTIME_DAY3_3 = 90;

    public static function getTypes($key = null)
    {
        $options = [
            self::TYPE_LIVESTREAM => 'Livestream - Audio',
            self::TYPE_WORKSHOP => 'Workshop',
            self::TYPE_RECORDING_AUDIO => 'Aufzeichnung - Audio',
            self::TYPE_RECORDING_VIDEO => 'Aufzeichnung - Video',
        ];

        if ($key !== null) {
            return $options[$key];
        }

        return $options;
    }

    public static function getWishtimes($key = null)
    {
        $options = [
            self::WISHTIME_DAY2_1 => 'Sa 14.08. - Morgens',
            self::WISHTIME_DAY2_2 => 'Sa 14.08. - Nachmittags',
            self::WISHTIME_DAY2_3 => 'Sa 14.08. - Abends',
            self::WISHTIME_DAY3_1 => 'So 15.08. - Morgens',
            self::WISHTIME_DAY3_2 => 'So 15.08. - Nachmittags',
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

}
