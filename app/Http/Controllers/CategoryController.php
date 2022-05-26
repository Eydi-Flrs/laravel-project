<?php

namespace App\Http\Controllers;

use App\Models\ActivityLog;
use App\Models\Post;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    //
    public function index(){
        return view('admin.categories.index',['categories'=>Category::all()]);
    }
    public function store(Request $request){
        request()->validate(['name'=>['unique:categories','required','string','max:255']]);

        Category::create([
            'name'=>Str::ucfirst(request('name')),
            'slug'=>Str::of(Str::lower(request('name')))->slug('-')
            ]
        );

        $ActivityLog = new ActivityLog();
        $ActivityLog->user_id=Auth::id();
        $ActivityLog->user_name=Auth::user()->name;
        $ActivityLog->stat='CREATE';
        $ActivityLog->activity_description='Category '.strtoupper($request->name).' created';
        $ActivityLog->date=Carbon::now('Asia/Manila')->toDateTimeString();
        $ActivityLog->save();


        session()->flash('category-created-message','category '.strtoupper($request->name).' was created');
        return redirect()->route('categories.index');
    }

    public function destroy(Category $category, Request $request){
        //ayusin ko pa destroy logic
        $postAll=Post::all();
        $postTrashed=Post::onlyTrashed()->get();
//        dd($category->posts->count());
       if($postAll->count()==0 && $postTrashed->count()==0){
           $category->delete();

           $ActivityLog = new ActivityLog();
           $ActivityLog->user_id=Auth::id();
           $ActivityLog->user_name=Auth::user()->name;
           $ActivityLog->stat='DELETE';
           $ActivityLog->activity_description='Category '.strtoupper($category->name).' deleted';
           $ActivityLog->date=Carbon::now('Asia/Manila')->toDateTimeString();
           $ActivityLog->save();

           $request->session()->flash('message','post was deleted');
           return back();
       }
       else if($category->posts->count()>0 || $postTrashed->count()>0){
            $request->session()->flash('message','Category cannot be deleted because it has some related posts and archived still has posts');
            return redirect()->back();
       }
       else{
//           $this->authorize('delete',$category); //ilalagay sa taas aayusin pa
           $category->delete();

           $ActivityLog = new ActivityLog();
           $ActivityLog->user_id=Auth::id();
           $ActivityLog->user_name=Auth::user()->name;
           $ActivityLog->stat='DELETE';
           $ActivityLog->activity_description='Category '.strtoupper($category->name).' deleted';
           $ActivityLog->date=Carbon::now('Asia/Manila')->toDateTimeString();
           $ActivityLog->save();

           $request->session()->flash('message','post was deleted');
           return back();
       }


    }

    public function edit(Category $category){
//        $this->authorize('view', $category);
        return view('admin.categories.edit',['category'=> $category]);

    }

    public function update(Category $category,Request $request){

            $category->name=Str::ucfirst(request('name'));
            $category->slug=Str::of(request('name'))->slug('-');
            if($category->isDirty('name')){

                $category->save();
                session()->flash('category-updated','Category Update '.request('name'));

                $ActivityLog = new ActivityLog();
                $ActivityLog->user_id=Auth::id();
                $ActivityLog->user_name=Auth::user()->name;
                $ActivityLog->stat='UPDATE';
                $ActivityLog->activity_description='Category '.strtoupper(request('name')).' updated';
                $ActivityLog->date=Carbon::now('Asia/Manila')->toDateTimeString();
                $ActivityLog->save();

            }else{
                session()->flash('category-updated','Nothing has been updated');
            }


            return redirect()->route('categories.index');

    }
}
