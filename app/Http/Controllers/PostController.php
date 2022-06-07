<?php

namespace App\Http\Controllers;

use App\Models\ActivityLog;
use App\Models\Category;
use App\Models\Image;
use App\Models\Payment;
use App\Models\Post;
use App\Models\Author;
use App\Models\Tag;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{

    //View all Posts
    public function index(){
//        $posts =auth()->user()->posts()->paginate(5);
//        $posts=Post::paginate(10);
        $posts=Post::all();
        return view('admin.posts.index',['posts'=>$posts]);
    }

    //show all QR
    public function qr(){
    //$posts =auth()->user()->posts()->paginate(5);
        $posts=Post::all();
    //dd(route('post',1));
        return view('admin.posts.qr',['posts'=>$posts]);
    }

    //blog post
    public function show(Post $post,$slug){
        $post->increment('views');
        $paidPosts=Payment::where('user_id',Auth::id())->get();
        $paid= array();
        $count=0;
        foreach($paidPosts as $paidPost){
               $paid[$count]=$paidPost->post_id;
               $count++;
            }
        $date="";
        if($post->month !='none' && $post->day !='none'){
            $date.=$post->month.",".$post->day.",";
        }
        else if($post->month !='none'){
            $date.=$post->month.",";
        }
        $date.=$post->year;
        return view('blog-post',['post'=>$post])->with('paid',$paid)->with('date',$date);
    }

    //goto create Post page
    public function create(){
        $this->authorize('create',Post::class);
        return view('admin.posts.create',['categories'=>Category::all(),'tags'=>Tag::all()]);
    }

    //save Post
    public function store(Request $request){

       $inputs= $request->validate([
           'title'=>['required','string','max:255'],
           'course'=>['required','string','max:255'],
           'category_id'=>['required','string','max:255'],
           'month'=>['nullable','string','max:255'],
           'day'=>['nullable','string','max:255'],
           'year'=>['required','string','max:255'],
           'pages'=>['nullable','string','max:255'],
           'pdf'=>['required','file'],
           'volume'=>['nullable','string','max:255'],
           'series'=>['nullable','string','max:255'],
           'publisher'=>['nullable','string','max:255'],
           'isbn'=>['nullable','string','max:255'],
           'lc'=>['nullable','string','max:255'],
           'authornumber'=>['nullable','string','max:255'],
           'qr'=>['string','max:255'],
           'abstract'=>['required','string','max:2000'],
           'type'=>['required','string','max:255']
       ]);

       if ($request->pdf){
            $inputs['pdf'] = $request->pdf->store('pdf');
        }
        $inputs['key']=$request->title.$request->year;

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
                   'name'=>$request->firstname[$i]." ".$request->lastname[$i],
                   'email'=>$request->email[$i],
                ];
            $inputs['key'].= $request->firstname[$i].$request->lastname[$i];
            $id[$i]=$author->insertGetId($data[$i]);
        }

        $postCheck=Post::where('key',$inputs['key'])->first();
        if($postCheck === null){
            $post=auth()->user()->posts()->create($inputs);
            $post->tags()->attach($request->tag_id);
            $post->authors()->attach($id);

            $post->findOrFail($post->id);

            $width="250";
            $height="250";
            $link= route('post',[$post->id,$post->slug]);
            $date="";
            if($request->month!='none' && $request->day!='none'){
                $date.=$request->month.",".$request->day.','.$request->year;
            }
            else if($request->month!='none'){
                $date.=$request->month.','.$request->year;
            }
            $date.=$request->year;

            $authors="";
            foreach($post->authors as $author) {
                $authors.=$author->name."| ";
            }
            $pages="";
            if($request->pages){
                $data = "title: ".$request->title."  date: ".$date." author:".$authors." pages:".$request->pages."  visit this link: (".$link.")";
            }
            else{
                $data = "title: ".$request->title."  date: ".$date." author:".$authors."  visit this link: (".$link.")";
            }

            $url="https://chart.googleapis.com/chart?cht=qr&chs={$width}x{$height}&chl={$data}";
            $post->qr=$url;
            $post->save();

            if($request->has('images')){
                $count=1;
                foreach ($request->file('images') as $image){
                    $imageName=$inputs['title'].'-image-'.'page-'.$count.'.'.$image->extension();
                    $image->storeAs('pdf_images',$imageName);

                    Image::create([
                        'post_id'=>$post->id,
                        'image'=>$imageName
                    ]);
                    $count++;
                }
            }

            session()->flash('post-created-message','post '.strtoupper($inputs['title']).' was created');

            $ActivityLog = new ActivityLog();
            $ActivityLog->user_id=Auth::id();
            $ActivityLog->user_name=Auth::user()->name;
            $ActivityLog->stat='CREATE';
            $ActivityLog->activity_description='Post '.strtoupper($request->title).' created';
            $ActivityLog->date=Carbon::now('Asia/Manila')->toDateTimeString();
            $ActivityLog->save();
        }else{
            session()->flash('message','You insert a duplicate academic resource');
        }


       return redirect()->route('post.index');
    }

    //goto update post page
    public function edit(Post $post){
        return view('admin.posts.edit',['post'=>$post,'categories'=>Category::all(),'tags'=>Tag::all()]);
    }

    //destroy or softdelete post
    public function destroy($id){
        $post=Post::withTrashed()->where('id',$id)->firstOrFail();
        if(!is_null($post->deleted_at)){
            $post->deletePdf();
            $post->deletePdfImages();
            $post->forceDelete();
            $ActivityLog = new ActivityLog();
            $ActivityLog->user_id=Auth::id();
            $ActivityLog->user_name=Auth::user()->name;
            $ActivityLog->stat='DELETE';
            $ActivityLog->activity_description='Post '.strtoupper($post->title).' deleted';
            $ActivityLog->date=Carbon::now('Asia/Manila')->toDateTimeString();
            $ActivityLog->save();
           session()->flash('message','post was deleted');
        }
        else{
            $post->delete();
            $ActivityLog = new ActivityLog();
            $ActivityLog->user_id=Auth::id();
            $ActivityLog->user_name=Auth::user()->name;
            $ActivityLog->stat='ARCHIVE';
            $ActivityLog->activity_description='Post '.strtoupper($post->title).' archived';
            $ActivityLog->date=Carbon::now('Asia/Manila')->toDateTimeString();
            $ActivityLog->save();
            session()->flash('message','post was archived');
        }

        return back();
    }

    //show softdeleted Posts
    public function archived(){
        $archived= Post::onlyTrashed()->paginate(5);//onlytrashed
        return view('admin.posts.archived',['posts'=>$archived]);
    }

    //restore archived post
    public function restore($id,Request $request){
        $post=Post::withTrashed()->where('id',$id)->firstOrFail();
        $post->restore();
        $request->session()->flash('post-updated-message','post restored successfully');
        $ActivityLog = new ActivityLog();
        $ActivityLog->user_id=Auth::id();
        $ActivityLog->user_name=Auth::user()->name;
        $ActivityLog->stat='RESTORE';
        $ActivityLog->activity_description='Post '.strtoupper($post->title).' restored';
        $ActivityLog->date=Carbon::now('Asia/Manila')->toDateTimeString();
        $ActivityLog->save();
        return back();
    }

    //update Post
    public function update(Post $post,Request $request){
        $inputs= $request->validate([
            'title'=>['required','string','max:255'],
            'course'=>['required','string','max:255'],
            'category_id'=>['required','string','max:255'],
            'month'=>['nullable','string','max:255'],
            'day'=>['nullable','string','max:255'],
            'year'=>['required','string','max:255'],
            'pages'=>['nullable','string','max:255'],
            'pdf'=>['file'],
            'volume'=>['nullable','string','max:255'],
            'series'=>['nullable','string','max:255'],
            'publisher'=>['nullable','string','max:255'],
            'isbn'=>['nullable','string','max:255'],
            'lc'=>['nullable','string','max:255'],
            'authornumber'=>['nullable','string','max:255'],
            'qr'=>['string','max:255'],
            'abstract'=>['required','string','max:1000'],
            'type'=>['required','string','max:255']
        ]);

        if ($request->pdf){
            $post->deletePdf();
            $inputs['pdf'] = $request->pdf->store('pdf');
        }
        if($request->has('images')){
            $post->deletePdfImages();
            $count=1;
            foreach ($request->file('images') as $image){
                $imageName=$inputs['title'].'-image-'.'page-'.$count.'.'.$image->extension();
                $image->storeAs('pdf_images',$imageName);

                Image::create([
                    'post_id'=>$post->id,
                    'image'=>$imageName
                ]);
                $count++;
            }
        }

        $inputs['key']=$request->title.$request->year;

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
            $inputs['key'].= $request->firstname[$i].$request->lastname[$i];
            $author_id=$author->updateOrCreate($data[$i]);
            $id[$i]=$author_id->id;
        }
        $post->category_id=$request->category_id;
        $post->update($inputs);
        $post->tags()->sync($request->tag_id);
        $post->authors()->sync($id);

        $width="250";
        $height="250";
        $link= route('post',[$post->id,$post->slug]);
        $date="";
        if($request->month!='none' && $request->day!='none'){
            $date.=$request->month.",".$request->day.','.$request->year;
        }
        else if($request->month!='none'){
            $date.=$request->month.','.$request->year;
        }
        $date.=$request->year;

        $authors="";
        foreach($post->authors as $author) {
            $authors.=$author->name."| ";
        }

        if($request->pages){
            $data = "title: ".$request->title."  date: ".$date." author:".$authors." pages:".$request->pages."  visit this link: (".$link.")";
        }
        else{
            $data = "title: ".$request->title."  date: ".$date." author:".$authors."  visit this link: (".$link.")";
        }

        $url="https://chart.googleapis.com/chart?cht=qr&chs={$width}x{$height}&chl={$data}";
        $post->qr=$url;
        $post->save();


        $ActivityLog = new ActivityLog();
        $ActivityLog->user_id=Auth::id();
        $ActivityLog->user_name=Auth::user()->name;
        $ActivityLog->stat='UPDATE';
        $ActivityLog->activity_description='Post '.strtoupper($request->title).' updated';
        $ActivityLog->date=Carbon::now('Asia/Manila')->toDateTimeString();
        $ActivityLog->save();

        session()->flash('post-updated-message','post '.strtoupper($inputs['title']).' was updated');
        return redirect()->route('post.index');
    }

    //archived checked posts
    public function deleteCheckedPosts(Request $request){

        if(isset($request->delete_single)){
            $this->destroy($request->post);
            return redirect()->back();
        }

        if(isset($request->delete_all) && !empty($request->checkBoxArray)){
            $posts=Post::withTrashed()->whereIn('id',$request->checkBoxArray)->get();
            foreach ($posts as $post) {
                if (!is_null($post->deleted_at)) {
                    $post->deletePdf();
                    $post->forceDelete();
                    $ActivityLog = new ActivityLog();
                    $ActivityLog->user_id=Auth::id();
                    $ActivityLog->user_name=Auth::user()->name;
                    $ActivityLog->stat='DELETE';
                    $ActivityLog->activity_description='Post '.strtoupper($post->title).' deleted';
                    $ActivityLog->date=Carbon::now('Asia/Manila')->toDateTimeString();
                    $ActivityLog->save();
                    session()->flash('message', 'post was deleted');
                } else {
                    $post->delete();
                    $ActivityLog = new ActivityLog();
                    $ActivityLog->user_id=Auth::id();
                    $ActivityLog->user_name=Auth::user()->name;
                    $ActivityLog->stat='ARCHIVE';
                    $ActivityLog->activity_description='Post '.strtoupper($post->title).' archived';
                    $ActivityLog->date=Carbon::now('Asia/Manila')->toDateTimeString();
                    $ActivityLog->save();
                    session()->flash('message', 'post was archived');
                }
            }
            return redirect()->back();
        }
        return redirect()->back();
    }

//    public function filterDate(){
//        $posts=Post::all();
//        return view('admin.posts.index',['posts'=>$posts]);
//    }
}
