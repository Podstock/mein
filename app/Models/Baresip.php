<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Baresip extends Model
{
    use HasFactory;

    public function inc_users()
    {
        $this->users_count++;
        $this->save();
    }

    public function dec_users()
    {
        $this->users_count--;
        $this->save();
    }

    public function room()
    {
        return $this->belongsTo(Room::class);
    }
}
