<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use Illuminate\Http\Request;

class TagController extends Controller
{
    public function index()
    {
        $tags = Tag::all();
        return view('tags.index', compact('tags'));
    }

    public function create()
    {
        return view('tags.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:tags'
        ]);

        Tag::create([
            'name' => $request->name
        ]);

        return redirect()->route('dashboard')
               ->with('success', 'Tag ajouté avec succès');
    }

    public function destroy(Tag $tag)
    {
        $tag->delete();
        return back()->with('success', 'Tag supprimé');
    }
}
