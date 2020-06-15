<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Storage;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'screen_name',
        'name',
        'profile_image',
        'profile_text',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function followers() {
        return $this->belongsToMany(self::class, 'followers', 'followed_id', 'following_id');
    }

    public function follows() {
        return $this->belongsToMany(self::class, 'followers', 'following_id', 'followed_id');
    }

    public function follow($user_id)
    {
        return $this->follows()->attach($user_id);
    }

    public function unfollow($user_id)
    {
        return $this->follows()->detach($user_id);
    }

    public function isFollowing($user_id)
    {
        return (boolean) $this->follows()->where('followed_id', $user_id)->first(['id']);
    }

    public function isFollowed($user_id)
    {
        return (boolean) $this->followers()->where('following_id', $user_id)->first(['id']);
    }

    //Update image
    public function updateProfile(Array $params)
    {
        if(isset($params['profile_image'])){
            // $file_name = $params['profile_image']->store('public/profile_image');

            $file_name = $params['profile_image'];
            $path = Storage::disk('s3')->putFile('/', $file_name, 'public');

            $this::where('id', $this->id)
                ->update([
                    'screen_name' => $params['screen_name'],
                    'name' => $params['name'],

                    'profile_image' => Storage::disk('s3')->url($path),
                    // 'profile_image' => basename($file_name),
                    'profile_text' => $params['profile_text'],
                    'email' => $params['email'],
            ]);
        } else {
            $this::where('id', $this->id)
                ->update([
                    'screen_name' => $params['screen_name'],
                    'name' => $params['name'],
                    'profile_text' => $params['profile_text'],
                    'email' => $params['email'],
            ]);
        }

        return;
    }
}
