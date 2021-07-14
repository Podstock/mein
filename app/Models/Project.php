<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    public function getUrlAttribute()
    {
        $url = $this->attributes['url'];
        if (empty($url))
            return '';
        if (!preg_match("/^http(s){0,1}\:\/\//", $url)) {
            return 'https://' . $url;
        }

        return $url;
    }
}
