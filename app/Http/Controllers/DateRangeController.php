<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class DateRangeController extends Controller
{
   function index(Request $request){
       if(request()->ajax()){
           if(!empty($request->from_name)){
               $posts= Post::whereBetween('order_date',array($request->from_date,$request->to_date))->get();

           }
           else{
               $posts= Post::all();
           }
       }
   }
}
