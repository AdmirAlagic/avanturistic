<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TimelapseLike extends Model
{
    protected $table = 'timelapses_likes';
    protected $fillable = [
        'user_id',
        'timelapse_id',
        'timelaps_user_id',
    ];

    public function user(){
        return $this->belongsTo(User::class, 'user_id');
    }
    public function timelapse(){
        return $this->belongsTo(Timelapse::class, 'timelapse_id');
    }
}
