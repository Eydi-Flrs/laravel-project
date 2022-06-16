<?php

namespace App\Http\Controllers;

use App\Models\ActivityLog;
use App\Models\Role;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules\Password;

class UserController extends Controller
{
    //show Users
    public function index(Request $request){
//        $users=User::all();
        $users = User::select("*")
            ->whereNotNull('last_seen')
            ->orderBy('last_seen', 'DESC')
            ->paginate(10);

        return view('admin.users.index', compact('users'));
//        return view('admin.users.index',['users'=>$users]);
    }

    //goto User profile
    public function show(User $user){
        return view('admin.users.profile',['user'=>$user,'roles'=>Role::all()]);
    }

    // update Users
    public function update(User $user,Request $request){
        $inputs =$request->validate([
            'firstname'=>['required','string','max:255'],
            'lastname'=>['required','string','max:255'],
            'email'=>['required','string','max:255'],
            'contact_number'=>['required','string','min:8','max:11'],
            'avatar'=>['file'],
        ]);

        if(request('password')!=""){
            $this->validate( $request,['password'=>'same:password_confirmation',
                Password::min(8)->letters()->numbers()->mixedCase()
            ]);
            $inputs['password']=$request->password;
        }

        if(request('avatar')){
            $user->deleteAvatar();
            $file=$request->file('avatar');
            $filename=$request->email.$file->getClientOriginalName();
            $file->move('storage/images/',$filename);
            $inputs['avatar'] = $filename;
//            $inputs['avatar'] = $request->avatar->store('images');
        }
//        $user->remember_token=Carbon::now();
        $user->name =$request->firstname." ".$request->lastname;
        $user->update($inputs);

        session()->flash('user-updated-message','Profile Successfully Updated');

        $ActivityLog = new ActivityLog();
        $ActivityLog->user_id=Auth::id();
        $ActivityLog->user_name=Auth::user()->name;
        $ActivityLog->stat='UPDATE';
        $ActivityLog->activity_description='User '.strtoupper($request->name).' updated';
        $ActivityLog->date=Carbon::now('Asia/Manila')->toDateTimeString();
        $ActivityLog->save();
        return back();
    }

    //attach admin role to user
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

    //detach admin role to user
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

    //delete or softdelete User
    public function destroy($id){
        $user=User::withTrashed()->where('id',$id)->firstOrFail();
//        $this->authorize('delete',$post);
        if(!is_null($user->deleted_at)){
            $user->deleteAvatar();
            $user->forceDelete();
            $ActivityLog = new ActivityLog();
            $ActivityLog->user_id=Auth::id();
            $ActivityLog->user_name=Auth::user()->name;
            $ActivityLog->stat='DELETE';
            $ActivityLog->activity_description='User '.strtoupper($user->name).' deleted';
            $ActivityLog->date=Carbon::now('Asia/Manila')->toDateTimeString();
            $ActivityLog->save();
            session()->flash('message','user '.$user->name.' was deleted');
        }
        else{
            $user->delete();
            $ActivityLog = new ActivityLog();
            $ActivityLog->user_id=Auth::id();
            $ActivityLog->user_name=Auth::user()->name;
            $ActivityLog->stat='ARCHIVE';
            $ActivityLog->activity_description='User '.strtoupper($user->name).' archived';
            $ActivityLog->date=Carbon::now('Asia/Manila')->toDateTimeString();
            $ActivityLog->save();
            session()->flash('message','user '.$user->name.' was archived');
        }

        return back();
    }

    //goto archived Users
    public function archived(){
        $archived= User::onlyTrashed()->get();//onlytrashed
        return view('admin.users.archived',['users'=>$archived]);
    }

    //restore archived Users
    public function restore($id,Request $request){
        $user=User::withTrashed()->where('id',$id)->firstOrFail();
        $user->restore();
        $request->session()->flash('post-updated-message','post restored successfully');
        $ActivityLog = new ActivityLog();
        $ActivityLog->user_id=Auth::id();
        $ActivityLog->user_name=Auth::user()->name;
        $ActivityLog->stat='RESTORE';
        $ActivityLog->activity_description='User '.strtoupper($user->title).' restored';
        $ActivityLog->date=Carbon::now('Asia/Manila')->toDateTimeString();
        $ActivityLog->save();
        session()->flash('user-restore','user '.$user->name.' was restored');
        return back();
    }
}
