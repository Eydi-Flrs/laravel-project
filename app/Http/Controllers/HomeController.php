<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Favorite;
use App\Models\Tag;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use PhpParser\Builder;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
//        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $posts= Post::all();
        $categories=Category::all();

        $favorites= Favorite::where('user_id',Auth::id())->get();
//        foreach ($favorites as $favorite){
//            foreach ($posts->where('id',$favorite->post_id) as $post ){
//                echo $post->title . ",";
//            }
//        }

        return view('home',['posts' => $posts])
            ->with('categories',$categories)
            ->with('favorites',$favorites)
            ->with('auth_id',Auth::id())
            ->with('carbon',Carbon::now())
            ->with('tags',Tag::all());
    }
    public function search(Request $request){
        $posts= Post::all();
        $categories=Category::all();
        $favorites= Favorite::where('user_id',Auth::id())->get();

        if($request->title){
            $posts= Post::where('title','LIKE','%'.$request->title.'%')
                ->orWhere('abstract','LIKE','%'.$request->title.'%')->get();
        }
        if($request->author){
            $author=$request->author;
            $posts=Post::whereHas('authors',function ($query) use($author){
                $query->where('name','LIKE','%'.$author.'%');
            })->get();}
        if($request->category_id){
            $posts= Post::where('category_id',$request->category_id)->get();
        }
        if($request->year) {
            $posts= Post::where('year',$request->year)->get();
        }
        if($request->title && $request->author) {
            $posts= Post::where('title','LIKE','%'.$request->title.'%')
                ->whereHas('authors',function ($query) use($author){
                    $query->where('name','LIKE','%'.$author.'%');
                })->get();
        }

        if($request->title && $request->author && $request->category_id) {
            $posts= Post::where('title','LIKE','%'.$request->title.'%')
                ->whereHas('authors',function ($query) use($author){
                    $query->where('name','LIKE','%'.$author.'%');
                })
                ->where('category_id',$request->category_id)
                ->get();
        }

        if($request->title && $request->author && $request->category_id && $request->year) {
            $posts= Post::where('title','LIKE','%'.$request->title.'%')
                ->whereHas('authors',function ($query) use($author){
                    $query->where('name','LIKE','%'.$author.'%');
                })
                ->where('category_id',$request->category_id)
                ->where('year',$request->year)
                ->get();
        }

        return view('home',['posts'=>$posts])
            ->with('categories',$categories)
            ->with('favorites',$favorites)
            ->with('carbon',Carbon::now())
            ->with('tags',Tag::all());

    }

    public function searchCategory($category_id){
        $categories=Category::all();
        $favorites= Favorite::where('user_id',Auth::id())->get();
        $posts= Post::where('category_id',$category_id)->get();

        return view('home',['posts'=>$posts])
            ->with('categories',$categories)
            ->with('favorites',$favorites)
            ->with('carbon',Carbon::now())
            ->with('tags',Tag::all());

    }
    public function searchYear($year){
        $categories=Category::all();
        $favorites= Favorite::where('user_id',Auth::id())->get();
        $posts= Post::where('year',$year)->get();

        return view('home',['posts'=>$posts])
            ->with('categories',$categories)
            ->with('favorites',$favorites)
            ->with('carbon',Carbon::now())
            ->with('tags',Tag::all());

    }

    public function searchTag($tag){
        $categories=Category::all();
        $favorites= Favorite::where('user_id',Auth::id())->get();
        $posts=Post::whereHas('tags',function ($query) use ($tag){
            $query->where('tag_id',$tag);
        })->get();
        return view('home',['posts'=>$posts])
            ->with('categories',$categories)
            ->with('favorites',$favorites)
            ->with('carbon',Carbon::now())
            ->with('tags',Tag::all());

    }
}
