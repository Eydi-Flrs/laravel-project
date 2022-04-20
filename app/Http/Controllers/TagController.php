<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tag;
use Illuminate\Support\Str;

class TagController extends Controller
{
    //
    public function index(){
        return view('admin.tags.index',['tags'=>Tag::all()]);
    }
    public function store(Request $request){
        request()->validate(['tag'=>['required','string','max:255']]);

        Tag::create([
                'name'=>Str::ucfirst(request('tag')),
                'slug'=>Str::of(Str::lower(request('tag')))->slug('-')
            ]
        );
        session()->flash('tag-created-message','post '.strtoupper($request->tag). 'was created');
        return redirect()->route('tags.index');
    }

    public function destroy(Tag $tag, Request $request){
//        $this->authorize('delete',$tag);
        $tag->delete();
        $request->session()->flash('message','post was deleted');
        return back();
    }

    public function edit(Tag $tag){
        $this->authorize('view', $tag);
        return view('admin.tags.edit',['tag'=> $tag]);

    }

    public function update(Tag $tag,Request $request){

        $tag->name=Str::ucfirst(request('name'));
        $tag->slug=Str::of(request('name'))->slug('-');
        if($tag->isDirty('name')){
            session()->flash('tag-updated','Tag Update '.request('name'));
            $tag->save();
        }else{
            session()->flash('tag-updated','Nothing has been updated');
        }


        return back();

    }
}
