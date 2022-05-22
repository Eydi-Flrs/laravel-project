<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    use HasFactory;
    protected $guarded=[];

    public function image():Attribute{
        return Attribute::make(
            get: fn($value)=>asset("/storage/pdf_images/".$value),
        );

    }
}
