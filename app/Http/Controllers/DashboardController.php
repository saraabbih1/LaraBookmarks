<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Tag;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $categories = Category::with([ 'links'=>function($query)use ($request){
            if($request->q){
                $query->where('title','like','%'.$request->q.'%');
            }
        }])
            ->where('user_id', auth()->id())
            ->get();

        $tags = Tag::all();

        return view('dashboard', compact('categories', 'tags')); // <-- ici
    }
}
