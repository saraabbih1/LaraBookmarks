<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Tag;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $categories = Category::with('links')
            ->where('user_id', auth()->id())
            ->get();

        $tags = Tag::all();

        return view('dashboard', compact('categories', 'tags')); // <-- ici
    }
}
