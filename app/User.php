<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Cache;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Notifications\VerifyEmail;

class User extends Authenticatable implements MustVerifyEmail
{
    use Notifiable, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'email',
        'password',
        'name',
        'name_slug',
        'email_verified_at',
        'avatar',
        'country_code',
        'description',
        'lat',
        'lng',
        'location_updated_at',
        'options',
        'fb_id',
        'social_links',
        'users',
        'last_login_at',
        'newsletter',
        'fcm_token'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public $dates = [
        'created_at', 'updated_at', 'last_login_at', 'location_updated_at'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'options' => 'array',
        'social_links' => 'array'
    ];

    public function isOnline()
    {
        return Cache::has('user-is-online-' . $this->id);
    }

    public static $_USER_GROUP_USER = 1;
    public static $_USER_GROUP_ADMIN = 2;

    public static function getUserGroups(){
        return [
            self::$_USER_GROUP_USER => 'User',
            self::$_USER_GROUP_ADMIN => 'Admin',
        ];
    }


    public function posts(){
        return $this->hasMany(Post::class, 'user_id');
    }

    public function timelapses(){
        return $this->hasMany(Timelapse::class, 'user_id');
    }

    public function unreadMessages(){
        return $this->hasMany(Message::class, 'to_user_id')->where('seen', 0)->with('from', 'to');
    }
    public function visitedPosts(){
        return $this->hasMany(PostVisited::class, 'user_id');
    }

    public function getUserGroup(){
        return $this->group;
    }
    public function favorites(){
        return $this->hasMany(FavoriteUser::class, 'user_id');

    }
    public function blog(){
        return $this->hasMany(Blog::class, 'user_id');

    }

    public function notifications(){
        return $this->hasMany(Notification::class, 'user_id');

    }

    public function country(){
        return $this->hasOne(Country::class, 'code2', 'country_code');
    }

    public function myCountryPosts(){
        return $this->hasMany(Post::class, 'user_id')->where('country_code', isset($this->country->code3) ? $this->country->code3 : 0);
    }

    public function sendEmailVerificationNotification()
    {
        $this->notify(new VerifyEmail); 
    }

    public function scopeLatest($query){
        return $query->orderBy('created_at', 'desc');
    }
}
