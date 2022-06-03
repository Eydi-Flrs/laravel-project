<?php

namespace App\Http\Controllers;
use App\Models\Post;
use Illuminate\Http\Request;

class TypeaheadController extends Controller
{
    public function autocompleteSearch(Request $request)
    {
        $query = $request->get('query');
        $filterResult = Post::where('name', 'LIKE', '%'. $query. '%')->get();
        return response()->json($filterResult);
    }
}
