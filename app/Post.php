<?php

namespace App;

use App\Facades\CurrencyHelper;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use SoftDeletes;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title',
        'slug',
        'description',
        'lat',
        'lng',
        'image',
        'video',
        'likes',
        'dislikes',
        'user_id',
        'include_location',
        'visiteds',
        'user_reported_ids',
        'options',
        'comments_count',
        'address',
        'is_public',
        'show_on_map',
        'country_code',
        'embeded_code',
        'map_options',
        'views',
        'has_route',
        'is_recommended',
        'price',
        'currency_code'
    ];

    protected $casts = [
        'image' => 'array',
        'user_reported_ids' => 'array',
        'options' => 'array',
        'map_options' => 'array'
    ];
    public function user(){
        return $this->belongsTo(User::class, 'user_id');
    }
    public function comments(){
        return $this->hasMany(Comment::class, 'post_id');
    }
    public function likesModel(){
        return $this->hasMany(PostLike::class, 'post_id');
    }
    public function visitedBy(){
        return $this->hasMany(PostVisited::class, 'post_id');
    }

    public function scopePublic($query){
        return $query->where('is_public', true);
    }

    public function scopeLatest($query){
        return $query->orderBy('created_at', 'desc');
    }

    public function scopeShowOnMap($query){
        return $query->where('show_on_map', true);
    }

    public function country(){
        return $this->hasOne(Country::class, 'code3', 'country_code');
    }

    public function timelapse(){
        return $this->hasOne(Timelapse::class, 'post_id');
    }

    public function getDisplayPriceAttribute(){
        return CurrencyHelper::displayAmountToUserByNumberOfDecimals($this->price, 2);
    }
}