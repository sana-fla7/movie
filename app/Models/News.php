<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    protected $fillable = ['title' , 'description' ,"content" , "image" , 'admin_id' , 'category_id'  ,  "status"];

    public function category()
    {
        return $this->belongsTo(CategoryNews::class, 'category_id');
    }
    public function admin()
    {
        return $this->belongsTo(Admin::class, 'admin_id');
    }
}
