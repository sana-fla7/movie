<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Collection extends Model
{
    protected $fillable = ['title' ,'movie-id', "image" ];

    public function movies()
    {
        return $this->belongsTo(Movie::class, 'movie_id');
    }
}
