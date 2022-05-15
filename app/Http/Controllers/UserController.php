<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(Request $request){
//        $users=User::all();
        $users = User::select("*")
            ->whereNotNull('last_seen')
            ->orderBy('last_seen', 'DESC')
            ->paginate(10);

        return view('admin.users.index', compact('users'));
//        return view('admin.users.index',['users'=>$users]);
    }
    public function show(User $user){
        return view('admin.users.profile',['user'=>$user,'roles'=>Role::all()]);
    }
    public function update(User $user,Request $request){
        $inputs =$request->validate([
            'firstname'=>['required','string','max:255'],
            'lastname'=>['required','string','max:255'],
            'email'=>['required','string','max:255'],
            'contact_number'=>['required','string','min:8','max:11'],
            'avatar'=>['file'],
            'password'=>['string',' same:password_confirmation']
        ]);

        if(request('avatar')){
            $inputs['avatar'] = $request->avatar->store('images');
        }
        $user->name =$request->lastname.",".$request->firstname;
        $user->update($inputs);
        return back();
    }
    public function destroy(User $user){
        $user->delete();
        session()->flash('user-deleted','User has been deleted');
        return back();
    }
    public function attach(User $user){
        $user->roles()->attach(request('role'));
        return back();
    }
    public function detach(User $user){
        $user->roles()->detach(request('role'));
        return back();
    }
}
