<?php

namespace App\Http\Controllers;

use App\Models\Permission;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class RoleController extends Controller
{
    //show Roles optional
    public function index(){
        return view('admin.roles.index',['roles'=>Role::all()]);
    }

    //goto edit Role
    public function edit(Role $role){

        return view('admin.roles.edit',[
            'role'=>$role,
            'permissions'=>Permission::all()
        ]);
    }

    //update Role
    public function update(Role $role){
        $role->name=Str::ucfirst(request('name'));
        $role->slug=Str::of(request('name'))->slug('-');
        if($role->isDirty('name')){
            session()->flash('role-updated','Role Update '.request('name'));
            $role->save();
        }else{
            session()->flash('role-updated','Nothing has been updated');
        }

        return back();
    }

    //store Role
    public function store(){
        request()->validate([
            'name'=>['required']
        ]);
        Role::create([
           'name'=>Str::ucfirst(request('name')),
            'slug'=>Str::of(Str::lower(request('name')))->slug('-')
        ]);
       return back();
    }

    //attach Admin Role
    public function attach_permission(Role $role){
        $role->permissions()->attach(request('permission'));
        return back();
    }

    //detach Admin Role
    public function detach_permission(Role $role){
        $role->permissions()->detach(request('permission'));
        return back();
    }

    //delete Role
    public function destroy(Role $role){

        $role->delete();
        session()->flash('role-deleted','Deleted Role '.$role->name);
        return back();
    }
}
