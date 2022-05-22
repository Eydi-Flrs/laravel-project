<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use App\Models\Category;
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
                session()->flash('category-updated','Category Update '.request('name'));
                $category->save();
            }else{
                session()->flash('category-updated','Nothing has been updated');
            }


            return redirect()->route('categories.index');

    }
}
