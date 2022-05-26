<?php

namespace App\Http\Controllers;

use App\Models\ActivityLog;
use App\Models\Role;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
        ]);

        if(request('password')!=""){
            $this->validate( $request,['password'=>'same:password_confirmation']);
            $inputs['password']=$request->password;
        }

        if(request('avatar')){
            $user->deleteAvatar();
            $inputs['avatar'] = $request->avatar->store('images');
        }
//        $user->remember_token=Carbon::now();
        $user->name =$request->lastname.",".$request->firstname;
        $user->update($inputs);


            session()->flash('user-updated-message','user '.strtoupper($user->name). 'was updated');

        $ActivityLog = new ActivityLog();
        $ActivityLog->user_id=Auth::id();
        $ActivityLog->user_name=Auth::user()->name;
        $ActivityLog->stat='UPDATE';
        $ActivityLog->activity_description='User '.strtoupper($request->name).' updated';
        $ActivityLog->date=Carbon::now('Asia/Manila')->toDateTimeString();
        $ActivityLog->save();
        return back();
    }
    public function destroy(User $user){
        $user->deleteAvatar();
        $user->delete();
        session()->flash('user-deleted','User has been deleted');
        $ActivityLog = new ActivityLog();
        $ActivityLog->user_id=Auth::id();
        $ActivityLog->user_name=Auth::user()->name;
        $ActivityLog->stat='DELETE';
        $ActivityLog->activity_description='User '.strtoupper($user->name).' deleted';
        $ActivityLog->date=Carbon::now('Asia/Manila')->toDateTimeString();
        $ActivityLog->save();
        return back();
    }
    public function attach(User $user){
        $user->roles()->attach(request('role'));
        $ActivityLog = new ActivityLog();
        $ActivityLog->user_id=Auth::id();
        $ActivityLog->user_name=Auth::user()->name;
        $ActivityLog->stat='ATTACH';
        $ActivityLog->activity_description='User attach admin to '.strtoupper($user->name);
        $ActivityLog->date=Carbon::now('Asia/Manila')->toDateTimeString();
        $ActivityLog->save();
        return back();
    }
    public function detach(User $user){
        $user->roles()->detach(request('role'));
        $ActivityLog = new ActivityLog();
        $ActivityLog->user_id=Auth::id();
        $ActivityLog->user_name=Auth::user()->name;
        $ActivityLog->stat='DETACH';
        $ActivityLog->activity_description='User detach admin to '.strtoupper($user->name);
        $ActivityLog->date=Carbon::now('Asia/Manila')->toDateTimeString();
        $ActivityLog->save();
        return back();
    }
}
