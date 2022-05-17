<?php

namespace App\Http\Controllers;

use App\Models\Author;
use App\Models\Favorite;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FavoriteController extends Controller
{
    public function index(){
        $favorites=Favorite::where('user_id', auth()->user()->id)->get();
        $ids= $favorites->pluck('post_id');
        $posts = Post::whereIn('id',$ids)->get();

        return view('admin.favorites.favorite')->with('posts',$posts);
    }

    public function store(Request $request){

       $post_id = $request->post_id;
       $user_id = Auth::id();

      Favorite::create(['post_id'=> $post_id,'user_id'=>$user_id]);
      return back();
    }

    public function destroy($id){
        $favorite_post= Favorite::where('user_id',Auth::id())->where('post_id',$id);
            $favorite_post->delete();
            session()->flash('message','fave deleted');


        return back();
    }
}
