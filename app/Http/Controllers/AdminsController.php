<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class AdminsController extends Controller
{
    public function index(){
        $activeUser=0;
        $users=User::all();
        foreach($users as $user){
            if(Cache::has('user-is-online-' . $user->id)){
                $activeUser++;
            }
        }

        return view('admin.dashboard.index')->with('posts',Post::all())
            ->with('categories',Category::all())
            ->with('users',User::all())->with('activeUser',$activeUser);
    }
}
