<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Collection_movie extends Model
{
    protected $fillable = [ 'movie_id' , 'collection_id'  ];

    public function movie()
    {
        return $this->belongsTo(Movie::class, 'movie_id');
    }
    public function collection()
    {
        return $this->belongsTo(Collection::class, 'collection_id');
    }

}
