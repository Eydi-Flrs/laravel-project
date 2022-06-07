<?php

namespace App\Http\Controllers;

use App\Models\Permission;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PermissionController extends Controller
{
    //permission page optional functionality
    public function index(){
        return view('admin.permissions.index',['permissions'=>Permission::all()]);
    }

    //add Permission
    public function store(){
        request()->validate([
            'name'=>['required']
        ]);
        Permission::create([
            'name'=>Str::ucfirst(request('name')),
            'slug'=>Str::of(Str::lower(request('name')))->slug('-')
        ]);
        return back();
    }

    //goto update Permission Page
    public function edit(Permission $permission){
        return view('admin.permissions.edit',['permission'=>$permission]);
    }

    //update Permission
    public function update(Permission $permission){
        $permission->name=Str::ucfirst(request('name'));
        $permission->slug=Str::of(request('name'))->slug('-');
        if($permission->isDirty('name')){
            session()->flash('permission-updated','Permission Update '.request('name'));
            $permission->save();
        }else{
            session()->flash('permission-updated','Nothing has been updated');
        }


        return back();
    }

    //delete Permission
    public function destroy(Permission $permission){
        $permission->delete();
        return back();
    }
}
