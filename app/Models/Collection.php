<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Collection extends Model
{
    protected $table = 'collection';
    protected $fillable = ['title' ,'movie_id', "image" ];

    public function movies()
    {
        return $this->belongsTo(Movie::class, 'movie_id');
    }
}
