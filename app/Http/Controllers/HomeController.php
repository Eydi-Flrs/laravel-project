<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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

        return view('home',['posts' => $posts])->with('categories',$categories);
    }
    public function search(Request $request){
        $categories=Category::all();
        $posts= Post::where('title','LIKE','%'.$request->search.'%')
            ->orWhere('abstract','LIKE','%'.$request->search.'%')->get();
        return view('home',['posts'=>$posts])->with('categories',$categories);

    }
}
