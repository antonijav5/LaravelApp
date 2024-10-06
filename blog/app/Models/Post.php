<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'content'];

    /*
    * Eloquent relationship linking user and post
    */
    public function user() {
        return $this->belongsTo(User::class);
    }

     /*
    * Eloquent relationship linking comment and post
    */
    public function comments() {
        return $this->hasMany(Comment::class);
    }
}
