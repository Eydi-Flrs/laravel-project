<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;

class AdminsController extends Controller
{
    public function index(){
        return view('admin.index')->with('posts',Post::all())
            ->with('categories',Category::all())
            ->with('users',User::all());
    }
}
