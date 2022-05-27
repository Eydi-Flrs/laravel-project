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
        $posts= Post::paginate(10);
        $categories=Category::all();
        $favorites= Favorite::where('user_id',Auth::id())->get();
//        foreach ($favorites as $favorite){
//            foreach ($posts->where('id',$favorite->post_id) as $post ){
//                echo $post->title . ",";
//            }
//        }
//        if ($favorites->isEmpty()){
//            echo "alaws laman";
//        }

        return view('home',['posts' => $posts])
            ->with('categories',$categories)
            ->with('favorites',$favorites)
            ->with('auth_id',Auth::id())
            ->with('carbon',Carbon::now())
            ->with('tags',Tag::all())
            ->with('allposts',Post::all());
    }
    public function aboutUs()
    {
        return(view('about-us'));
    }

    public function autocomplete(Request $request){
        $data=$request->topNavSearch;
        $query=$data['query'];
        $filter_data=Post::select('title')->where('title','LIKE','%'.$query.'%')->get();
        return response()->json($filter_data);

    }

    public function search(Request $request){
        $posts= Post::paginate(10);
        $categories=Category::all();
        $favorites= Favorite::where('user_id',Auth::id())->get();

        if($request->title){
            $posts= Post::where('title','LIKE','%'.$request->title.'%')
                ->orWhere('abstract','LIKE','%'.$request->title.'%')->paginate(10);
        }
        if($request->author){
            $author=$request->author;
            $posts=Post::whereHas('authors',function ($query) use($author){
                $query->where('name','LIKE','%'.$author.'%');
            })->paginate(10);}
        if($request->category_id){
            $posts= Post::where('category_id',$request->category_id)->paginate(10);
        }
        if($request->year) {
            $posts= Post::where('year',$request->year)->paginate(10);
        }
        if($request->title && $request->author) {
            $posts= Post::where('title','LIKE','%'.$request->title.'%')
                ->whereHas('authors',function ($query) use($author){
                    $query->where('name','LIKE','%'.$author.'%');
                })->paginate(10);
        }

        if($request->title && $request->author && $request->category_id) {
            $posts= Post::where('title','LIKE','%'.$request->title.'%')
                ->whereHas('authors',function ($query) use($author){
                    $query->where('name','LIKE','%'.$author.'%');
                })
                ->where('category_id',$request->category_id)
                ->paginate(10);
        }

        if($request->title && $request->author && $request->category_id && $request->year) {
            $posts= Post::where('title','LIKE','%'.$request->title.'%')
                ->whereHas('authors',function ($query) use($author){
                    $query->where('name','LIKE','%'.$author.'%');
                })
                ->where('category_id',$request->category_id)
                ->where('year',$request->year)
                ->paginate(10);
        }

        return view('home',['posts'=>$posts])
            ->with('categories',$categories)
            ->with('favorites',$favorites)
            ->with('carbon',Carbon::now())
            ->with('tags',Tag::all())
            ->with('allposts',Post::all());

    }
    public function searchAll(Request $request){
        $posts= Post::paginate(10);
        $categories=Category::all();
        $favorites= Favorite::where('user_id',Auth::id())->get();
        $author=$request->topNavSearch;
        $posts= Post::where('title','LIKE','%'.$request->topNavSearch.'%')
            ->orwhereHas('authors',function ($query) use($author){
                $query->where('name','LIKE','%'.$author.'%');
            })
            ->orwhere('category_id',$request->topNavSearch)
            ->orwhere('year',$request->topNavSearch)
            ->paginate(10);

        return view('home',['posts'=>$posts])
            ->with('categories',$categories)
            ->with('favorites',$favorites)
            ->with('carbon',Carbon::now())
            ->with('tags',Tag::all())
            ->with('allposts',Post::all());
    }
//
    public function searchCategory($category_id){
        $categories=Category::all();
        $favorites= Favorite::where('user_id',Auth::id())->get();
        $posts= Post::where('category_id',$category_id)->paginate(10);

        return view('home',['posts'=>$posts])
            ->with('categories',$categories)
            ->with('favorites',$favorites)
            ->with('carbon',Carbon::now())
            ->with('tags',Tag::all())
            ->with('allposts',Post::all());

    }
    public function searchYear($year){
        $categories=Category::all();
        $favorites= Favorite::where('user_id',Auth::id())->get();
        $posts= Post::where('year',$year)->paginate(10);

        return view('home',['posts'=>$posts])
            ->with('categories',$categories)
            ->with('favorites',$favorites)
            ->with('carbon',Carbon::now())
            ->with('tags',Tag::all())
            ->with('allposts',Post::all());

    }
//
    public function searchTag($tag){
        $categories=Category::all();
        $favorites= Favorite::where('user_id',Auth::id())->get();
        $posts=Post::whereHas('tags',function ($query) use ($tag){
            $query->where('tag_id',$tag);
        })->paginate(10);
        return view('home',['posts'=>$posts])
            ->with('categories',$categories)
            ->with('favorites',$favorites)
            ->with('carbon',Carbon::now())
            ->with('tags',Tag::all())
            ->with('allposts',Post::all());

    }
}
