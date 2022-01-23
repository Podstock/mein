<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use JoelButcher\Socialstream\HasConnectedAccounts;
use JoelButcher\Socialstream\SetsProfilePhotoFromUrl;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Str;


class User extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto {
        getProfilePhotoUrlAttribute as getPhotoUrl;
    }
    use HasConnectedAccounts;
    use Notifiable;
    use SetsProfilePhotoFromUrl;
    use TwoFactorAuthenticatable;

    const ROLE_USER = 0;
    const ROLE_ORGA = 1;
    const ROLE_ADMIN = 99;

    public static function getRole($key = null)
    {
        $options = [
            self::ROLE_USER => 'User',
            self::ROLE_ORGA => 'Orga',
            self::ROLE_ADMIN => 'Admin',
        ];

        if ($key !== null) {
            return $options[$key];
        }

        return $options;
    }

    public function isAdmin()
    {
        return $this->role === self::ROLE_ADMIN;
    }

    public function isOrga()
    {
        return $this->role === self::ROLE_ORGA;
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'nickname', 'password', 'sendegate', 'twitter'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'role' => 'integer'
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        'profile_photo_url',
    ];

    /**
     * Get the URL to the user's profile photo.
     *
     * @return string
     */
    public function getProfilePhotoUrlAttribute()
    {
        if (!empty($this->profile_photo_path))
            return "/storage/small/" . $this->profile_photo_path;

        return "/avatar.png";
    }

    public function talks()
    {
        return $this->hasMany(Talk::class);
    }

    public function tent()
    {
        return $this->hasOne(Tent::class);
    }

    public function projects()
    {
        return $this->hasMany(Project::class);
    }

    public function getNicknameAttribute()
    {
        if (!empty($this->attributes['nickname']))
            return $this->attributes['nickname'];

        $accs = $this->connectedAccounts;

        foreach ($accs as $acc) {
            if ($acc->nickname)
                return $acc->nickname;
        }

        return preg_replace('/[^A-Za-z0-9-_]/', '', $this->attributes['name']);
    }

    public function getUuidAttribute()
    {
        if (!empty($this->attributes['uuid']))
            return $this->attributes['uuid'];

        $this->attributes['uuid'] = Str::uuid();
        $this->save();
        return $this->attributes['uuid'];
    }

    public function rooms()
    {
        return $this->belongsToMany(Room::class)->withPivot('role');
    }

    public function is_speaker($room_id)
    {
        $room = Room::find($room_id);
        if (!$room->show)
            return true;

        $role = (int)$this->rooms()
            ->whereRoomId($room_id)->first()?->pivot->role;
        if ($role >= Room::SPEAKER)
            return true;

        return false;
    }

    public function room_speaker(Room $room)
    {
        $room->users()->attach($this->id, ['role' => Room::SPEAKER]);
    }

    public function room_listener(Room $room)
    {
        $room->users()->detach($this->id);
    }

    public function is_moderator($room_id)
    {
        if ($this->isAdmin())
            return true;

        if ($this->isOrga())
            return true;

        $role = (int)$this->rooms()
            ->whereRoomId($room_id)->first()?->pivot->role;
        if ($role >= Room::MODERATOR)
            return true;

        return false;
    }
}
