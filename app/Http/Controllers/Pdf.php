<?php

namespace App\Http\Controllers;
use App\Models\Post;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;

class Pdf extends Controller
{
    // button for downloading pdf
    public function downloadpdf(Post $post){
        $myString=$post->pdf;
        $findMe='/';
        $lenght0fString=strlen($myString);
        $pos=strrpos($myString, $findMe)+1;
        $trim=substr($myString,$pos,$lenght0fString);
        $path='storage\\'.'pdf'.'\\'.$trim;
        return response()->download($path);
    }
}
