<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Favorite extends Model
{
    protected $guarded=[];
    use HasFactory;

    public function users(){
        return $this->belongsToMany(User::class);
    }
    public function posts(){
        return $this->belongsToMany(Post::class);
    }
}
