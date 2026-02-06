<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Tag;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
  public function index(Request $request)
{
    $categoriesQuery = Category::where('user_id', auth()->id())
        ->with(['links' => function ($query) use ($request) {
            if ($request->filled('tag')) {
                $query->whereHas('tags', function ($q) use ($request) {
                    $q->where('tags.id', $request->tag);
                });
            }
        }]);

    if ($request->filled('category')) {
        $categoriesQuery->where('id', $request->category);
    }

    $categories = $categoriesQuery->get();

    $tags = Tag::all();

    return view('dashboard', compact('categories', 'tags'));
}
}