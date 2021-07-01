<?php

namespace App;

use App\Category;
use App\PostImage;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = [
        'title', 
        'url_clean', 
        'content', 
        'category_id', 
        'posted'
    ];
//un post pertenece a una categoria
    public function category(){
        return $this->belongsTo(Category::class);
    }
//una imagen pertenece a un post
    public function image(){
        return $this->hasOne(PostImage::class);
    }

    public function images(){
        return $this->hasMany(PostImage::class);
    }
    
    public function tags()
    {
        return $this->morphToMany(Tag::class, 'taggable');
    }
    
}
