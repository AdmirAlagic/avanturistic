<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FavoriteUser extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'favorites';

    protected $fillable = [
        'user_id',
        'favorite_user_id',
    ];

    protected $casts = [
        'users' => 'array'
    ];

    public function user(){
        return $this->belongsTo(User::class, 'favorite_user_id');
    }

}
