<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\URL;

class Post extends Model
{
    use SoftDeletes;
    use HasFactory;
    protected $guarded=[];

    public function authors(){
        return $this->belongsToMany(Author::class);
    }
    public function favorites(){
        return $this->belongsToMany(Favorite::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function category(){
        return $this->belongsTo(Category::class);
    }

    public function tags(){
        return $this->belongsToMany(Tag::class);
    }
//    public function qr():Attribute{
//        return Attribute::make(
//            set:fn($value)=>substr($value,7),
//            get: fn($value)=>asset("storage/images/".$value),
//        );
//
//    }
    public function pdf():Attribute{
        return Attribute::make(
            set:fn($value)=>substr($value,4),
            get: fn($value)=>asset("/storage/pdf/".$value),
        );

    }


    public function hasTag($tagId){
        return in_array($tagId,$this->tags->pluck('id')->toArray());
    }

    public function deletePdf(){
        $myString=$this->pdf;
        $findMe='/';
        $lenght0fString=strlen($myString);
        $pos=strrpos($myString, $findMe)+1;
        $trim=substr($myString,$pos,$lenght0fString);
        $pdfPath='pdf/'.$trim;
//            dd($pdfPath);
        Storage::delete($pdfPath);
    }
}

