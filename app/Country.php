<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title',
        'origin_title',
        'slug',
        'code2',
        'code3',
        'lat',
        'lng',
        'min_lat',
        'max_lat',
        'min_lng',
        'max_lng',
        'language',
        'phone_code',
        'emoji',
        'svg',
        'geo_data',
        'region',
        'subregion'
    ];

    protected $casts = [
        'geo_data' => 'array'
    ];
 
    public function posts(){
        return $this->hasMany(Post::class, 'country_code', 'code3');
    }
}
