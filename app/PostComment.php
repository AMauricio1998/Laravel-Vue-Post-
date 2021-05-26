<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;

class PostComment extends Model
{
    protected $fillable = [
        "post_id",
        "title",
        "message",
        "user_id",
        "approved"

    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
}
