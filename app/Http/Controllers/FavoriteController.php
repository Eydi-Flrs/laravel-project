<?php

namespace App\Http\Controllers;

use App\Models\Author;
use App\Models\Favorite;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FavoriteController extends Controller
{
    public function store(Request $request){

       $post_id = $request->post_id;
       $user_id = Auth::id();

      Favorite::create(['post_id'=> $post_id,'user_id'=>$user_id]);
      return back();
    }
}
