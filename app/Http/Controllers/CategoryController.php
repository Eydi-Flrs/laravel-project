<?php

namespace App\Http\Controllers;

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
        request()->validate(['category'=>['required','string','max:255']]);

        Category::create([
            'name'=>Str::ucfirst(request('category')),
            'slug'=>Str::of(Str::lower(request('category')))->slug('-')
            ]
        );
        session()->flash('category-created-message','post '.strtoupper($request->category). 'was created');
        return redirect()->route('categories.index');
    }
    public function destroy(Category $category, Request $request){
        $this->authorize('delete',$category);
        $category->delete();
        $request->session()->flash('message','post was deleted');
        return back();
    }
}
