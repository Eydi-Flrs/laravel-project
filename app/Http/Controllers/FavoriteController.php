<?php

namespace App\Http\Controllers;

use App\Models\Author;
use App\Models\Favorite;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FavoriteController extends Controller
{
    //goto Saved page
    public function index(){
        $favorites=Favorite::where('user_id', auth()->user()->id)->get();
        $ids= $favorites->pluck('post_id');
        $posts = Post::whereIn('id',$ids)->paginate(10);

        return view('admin.favorites.favorite')->with('posts',$posts);
    }

    //button for read it later
    public function store(Request $request){
       $post_id = $request->post_id;
       $user_id = Auth::id();
      Favorite::create(['post_id'=> $post_id,'user_id'=>$user_id]);
      return back();
    }

    //remove Bookmarked post
    public function destroy($id, Request $request){
        $favorite_post= Favorite::where('user_id',Auth::id())->where('post_id',$id);
        session()->flash('message',$request->title.' has been removed');
            $favorite_post->delete();
        return back();
    }
}
