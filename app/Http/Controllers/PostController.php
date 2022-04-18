<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Author;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class PostController extends Controller
{
    public function index(){
//        $posts =auth()->user()->posts()->paginate(5);
        $posts=Post::paginate(5);
        return view('admin.posts.index',['posts'=>$posts]);
    }

    public function show(Post $post){
        return view('blog-post',['post'=>$post]);
    }

    public function create(){
        $this->authorize('create',Post::class);
        return view('admin.posts.create');
    }
    public function store(Request $request){
       $inputs= $request->validate([
           'title'=>['required','string','max:255'],
           'course'=>['required','string','max:255'],
           'date_published'=>'date',
           'pages'=>['string','max:255'],
           'pdf'=>'file',
           'volume'=>['string','max:255'],
           'series'=>['string','max:255'],
           'publisher'=>['string','max:255'],
           'year'=>['string','max:255'],
           'qr'=>['string','max:255'],
           'abstract'=>['required','string','max:255'],
           'type'=>['string','max:255']
       ]);
       $width="250";
       $height="250";
       $data= $request->title." ".$request->abstract;
       $url="https://chart.googleapis.com/chart?cht=qr&chs={$width}x{$height}&chl={$data}";
       $inputs['qr']=$url;
//       dd($inputs['qr']);

       if ($request->pdf){
            $inputs['pdf'] = $request->pdf->store('pdf');
        }

       auth()->user()->posts()->create($inputs);
       session()->flash('post-created-message','post '.strtoupper($inputs['title']). 'was created');
       return redirect()->route('post.index');
    }

    public function edit(Post $post){
//        $this->authorize('view',$post);
        return view('admin.posts.edit',['post'=>$post]);

    }

    public function destroy(Post $post, Request $request){
        $this->authorize('delete',$post);
        $post->delete();
        $request->session()->flash('message','post was deleted');
        return back();
    }

    public function update(Post $post,Request $request){
        $inputs= $request->validate([
            'title'=>'required|min:0|max:255',
            'post_image'=>'file',
            'body'=>'required'
        ]);
        if ($request->post_image){
            $inputs['post_image'] = $request->post_image->store('images');
            $post->post_image =$inputs['post_image'];
        }
        $post->title =$inputs['title'];
        $post->body=$inputs['body'];
        $this->authorize('update',$post);

        posts()->update();
        session()->flash('post-updated-message','post '.strtoupper($inputs['title']). 'was updated');
        return redirect()->route('post.index');
    }
}
