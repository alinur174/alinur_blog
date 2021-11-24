<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;


    const IS_BANNED = 1;
    const IS_ACTIVE = 0;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'email',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public static function add($fieleds)
    {
        $user = new static;
        $user->fill($fieleds);
        $user->password = bcrypt($fieleds['password']);

        $user->save();
        return $user;
    }

    public function edit($fields)
    {
        $this->fill($fields);
        if ($fields['password'] != null)
            $this->password = bcrypt($fields['password']);

        $this->save();

    }

    public function remove()
    {
        Storage::delete('uploads/' . $this->avatar);
        $this->delete();
    }


    public function uploadAvatar($image)
    {
        if ($image == null)
            return;

        Storage::delete('uploads/' . $this->avatar);
        $fileName = Str::random(10) . '.' . $image->extension();
        $image->storeAs('uploads', $fileName);
        $this->avatar = $fileName;
        $this->save();

    }

    public function getImage()
    {

        if ($this->avatar == null)
            return '/img/no-image.png';

        return '/uploads/' . $this->avatar;
    }

    public function makeAdmin()
    {
        $this->is_admin = 1;
    }

    public function makeNormal()
    {
        $this->is_admin = 0;
    }


    public function toggleAdmin($value)
    {
        if ($value == null)
            return $this->makeNormal();
        return $this->makeAdmin();
    }


    public function ban()
    {
        $this->status = User::IS_BANNED;
        $this->save();
    }

    public function unban()
    {
        $this->status = User::IS_ACTIVE;
        $this->save();
    }


    public function toggleBan($value)
    {
        if ($value == null)
            return $this->unban();

        return $this->ban();
    }


}
