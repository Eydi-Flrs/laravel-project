<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\URL;

class Post extends Model
{
    use HasFactory;
    protected $guarded=[];

    public function authors(){
        return $this->belongsToMany(Author::class);
    }
    public function user(){
        return $this->belongsTo(User::class);
    }

    public function categories(){
        return $this->belongsToMany(Category::class);
    }
    public function qr():Attribute{
        return Attribute::make(
            set:fn($value)=>substr($value,7),
            get: fn($value)=>asset("storage/images/".$value),
        );

    }
    public function pdf():Attribute{
        return Attribute::make(
            set:fn($value)=>substr($value,7),
            get: fn($value)=>asset("storage/images/".$value),
        );

    }
}
