<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = [
        'title',
        'url_clean',
    ];

//Una categoria tiene muchos post
    public function post(){
        return $this->hasMany(Post::class);
    }

}
