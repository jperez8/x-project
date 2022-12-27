<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'google_id',
        'google_token',
        'google_refresh_token'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'google_id',
        'google_token',
        'google_refresh_token'
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'is_admin' => 'boolean'
    ];


    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    public function favs()
    {
        return $this->belongsToMany(Post::class);
    }

    public function profile()
    {
        return $this->hasOne(Profile::class);
    }

    public function followers()
    {
        return $this->belongsToMany(self::class, 'user_user', 'followed_id', 'follower_id')->withPivot('is_premium')->wherePivot('is_accepted', true);
    }

    public function followeds()
    {
        return $this->belongsToMany(self::class, 'user_user', 'follower_id', 'followed_id')->withPivot('is_premium')->wherePivot('is_accepted', true);
    }

    /**
     * Get the number of followers
     *
     * @return \Illuminate\Database\Eloquent\Casts\Attribute
     */
    protected function numFollowers(): Attribute
    {
        return Attribute::make(
            get: fn () => 125,
        );
    }

    /**
     * Get the number of followers
     *
     * @return \Illuminate\Database\Eloquent\Casts\Attribute
     */
    protected function numFolloweds(): Attribute
    {
        return Attribute::make(
            get: fn () => 30,
        );
    }
}
