<?php

namespace App\Http\Controllers;

use App\Models\ActivityLog;
use App\Models\Post;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\Tag;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class TagController extends Controller
{
    //show Tags
    public function index(){
        return view('admin.tags.index',['tags'=>Tag::all()]);
    }

    //save Tags
    public function store(Request $request){
        request()->validate(['name'=>['unique:tags','required','string','max:255','regex:/^[a-zA-Z ]+$/']],[
            'name.regex' => 'Category name must not have numerical value'
        ]);

        Tag::create([
                'name'=>Str::ucfirst(request('name')),
                'slug'=>Str::of(Str::lower(request('name')))->slug('-')
            ]
        );
        $ActivityLog = new ActivityLog();
        $ActivityLog->user_id=Auth::id();
        $ActivityLog->user_name=Auth::user()->name;
        $ActivityLog->stat='CREATE';
        $ActivityLog->activity_description='Tag '.strtoupper($request->name).' created';
        $ActivityLog->date=Carbon::now('Asia/Manila')->toDateTimeString();
        $ActivityLog->save();
        session()->flash('tag-created-message','tag '.strtoupper($request->name).' was created');
        return redirect()->route('tags.index');
    }

    //delete Tag
    public function destroy(Tag $tag, Request $request){
        $postAll=Post::all();
        $postTrashed=Post::onlyTrashed()->get();

        if($postAll->count()==0 && $postTrashed->count()==0){
            $tag->delete();
            $request->session()->flash('message','tag was deleted');
            $ActivityLog = new ActivityLog();
            $ActivityLog->user_id=Auth::id();
            $ActivityLog->user_name=Auth::user()->name;
            $ActivityLog->stat='DELETE';
            $ActivityLog->activity_description='Tag '.strtoupper($tag->name).' deleted';
            $ActivityLog->date=Carbon::now('Asia/Manila')->toDateTimeString();
            $ActivityLog->save();
            return back();
        }
        else if($tag->posts->count()>0 || $postTrashed->count()>0){
            $request->session()->flash('message','Tag cannot be deleted because it has some related posts and archived still has posts');
            return redirect()->back();
        }
        else{
//            $this->authorize('delete',$tag); //ilalagay sa taas aayusin pa
            $tag->delete();
            $request->session()->flash('message','Category was deleted');
            $ActivityLog = new ActivityLog();
            $ActivityLog->user_id=Auth::id();
            $ActivityLog->user_name=Auth::user()->name;
            $ActivityLog->stat='DELETE';
            $ActivityLog->activity_description='Tag '.strtoupper($tag->name).' deleted';
            $ActivityLog->date=Carbon::now('Asia/Manila')->toDateTimeString();
            $ActivityLog->save();
            return back();
        }


    }

    //goto edit tags
    public function edit(Tag $tag){
        return view('admin.tags.edit',['tag'=> $tag]);

    }

    //update Tag
    public function update(Tag $tag,Request $request){
        $tag->name=Str::ucfirst(request('name'));
        $tag->slug=Str::of(request('name'))->slug('-');
        if($tag->isDirty('name')){
            session()->flash('tag-updated','Tag Update '.request('name'));
            $tag->save();
            $ActivityLog = new ActivityLog();
            $ActivityLog->user_id=Auth::id();
            $ActivityLog->user_name=Auth::user()->name;
            $ActivityLog->stat='UPDATE';
            $ActivityLog->activity_description='Tag '.strtoupper(request('name')).' updated';
            $ActivityLog->date=Carbon::now('Asia/Manila')->toDateTimeString();
            $ActivityLog->save();
        }else{
            session()->flash('tag-updated','Nothing has been updated');
        }

        return redirect()->route('tags.index');

    }
}
