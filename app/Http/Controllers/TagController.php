<?php

namespace App\Http\Controllers;
use App\Models\Tag;

use Illuminate\Http\Request;

class TagController extends Controller
{
    public function store(Request $request){
        $request->validate(['name'=>'required|unique:tags']);
        Tag::create(['name'=>$request->name]);
        return back()->with('success','tag ajouté');
    }
}
