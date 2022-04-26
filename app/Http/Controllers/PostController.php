<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use App\Models\Author;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    public function index(){
//        $posts =auth()->user()->posts()->paginate(5);
        $posts=Post::paginate(5);
        return view('admin.posts.index',['posts'=>$posts]);
    }

    public function show(Post $post){
        $post->increment('views');
        return view('blog-post',['post'=>$post]);
    }

    public function create(){
        $this->authorize('create',Post::class);
        return view('admin.posts.create',['categories'=>Category::all(),'tags'=>Tag::all()]);
    }


    public function store(Request $request){
       $inputs= $request->validate([
           'title'=>['required','string','max:255'],
           'course'=>['required','string','max:255'],
           'category_id'=>['required','string','max:255'],
           'date_published'=>'date',
           'pages'=>['string','max:255'],
           'pdf'=>['required','file'],
           'volume'=>['string','max:255'],
           'series'=>['string','max:255'],
           'publisher'=>['string','max:255'],
           'year'=>['string','max:255'],
           'qr'=>['string','max:255'],
           'abstract'=>['required','string','max:1000'],
           'type'=>['string','max:255']
       ]);
       $width="250";
       $height="250";
       $data= $request->title." ".$request->abstract;
       $url="https://chart.googleapis.com/chart?cht=qr&chs={$width}x{$height}&chl={$data}";
       $inputs['qr']=$url;

       if ($request->pdf){
            $inputs['pdf'] = $request->pdf->store('pdf');
        }

        $author= new Author();
        $num=count($request->lastname);
        $data=[];
        $id=[];
        for($i=0;$i<$num;$i++){
            $data[$i]=[
                   'lastname'=>$request->lastname[$i],
                   'firstname'=>$request->firstname[$i],
                   'middle_initial'=>$request->middle_initial[$i],
                   'suffix'=>$request->suffix[$i],
                   'name'=>$request->lastname[$i].",".$request->firstname[$i],
                   'email'=>$request->email[$i],
                ];

            $id[$i]=$author->insertGetId($data[$i]);
//
        }

        $post=auth()->user()->posts()->create($inputs);
        $post->tags()->attach($request->tag_id);
        $post->authors()->attach($id);

       session()->flash('post-created-message','post '.strtoupper($inputs['title']). 'was created');
       return redirect()->route('post.index');
    }


    public function edit(Post $post){
        $this->authorize('view',$post);
        return view('admin.posts.edit',['post'=>$post,'categories'=>Category::all(),'tags'=>Tag::all()]);

    }


    public function destroy(Post $post, Request $request){
        $this->authorize('delete',$post);
        Storage::delete($post->pdf);
        $post->delete();
        $request->session()->flash('message','post was archived');
        return back();
    }


    public function archived(){
        $archived= Post::withTrashed()->paginate(5);
        return view('admin.posts.archived',['posts'=>$archived]);
    }


    public function update(Post $post,Request $request){
//        $this->authorize('update',$post);
        $inputs= $request->validate([
            'title'=>['required','string','max:255'],
            'course'=>['required','string','max:255'],
            'category_id'=>['required','string','max:255'],
            'date_published'=>'date',
            'pages'=>['string','max:255'],
            'pdf'=>['file'],
            'volume'=>['string','max:255'],
            'series'=>['string','max:255'],
            'publisher'=>['string','max:255'],
            'year'=>['string','max:255'],
            'qr'=>['string','max:255'],
            'abstract'=>['required','string','max:1000'],
            'type'=>['string','max:255']
        ]);
        $width="250";
        $height="250";
        $data= $request->title." ".$request->abstract;
        $url="https://chart.googleapis.com/chart?cht=qr&chs={$width}x{$height}&chl={$data}";
        $inputs['qr']=$url;

        if ($request->pdf){
            $inputs['pdf'] = $request->pdf->store('pdf');
        }
        $author= new Author();
        $num=count($request->lastname);
        $data=[];
        $id=[];
        for($i=0;$i<$num;$i++){
            $data[$i]=[
                'lastname'=>$request->lastname[$i],
                'firstname'=>$request->firstname[$i],
                'middle_initial'=>$request->middle_initial[$i],
                'suffix'=>$request->suffix[$i],
                'name'=>$request->lastname[$i].",".$request->firstname[$i],
                'email'=>$request->email[$i],
            ];

            $author_id=$author->updateOrCreate($data[$i]);
            $id[$i]=$author_id->id;
        }
        $post->category_id=$request->category_id;
        $post->update($inputs);
        $post->tags()->sync($request->tag_id);
        $post->authors()->sync($id);

        session()->flash('post-updated-message','post '.strtoupper($inputs['title']). 'was updated');
        return redirect()->route('post.index');
    }
}
