<?php
namespace App\Http\Controllers;
use App\Models\Link;
use App\Models\Tag;

use App\Models\Category;


use Illuminate\Http\Request;

class linkController extends Controller
{
    public function index(){
        $links = Link::wherehas('category',function($q){
            $q->where('user_id',auth()->user()->id);
        })->get();
        return view('links.index',compact('links'));
    }
    public function create(){
        $categories=Category::where('user_id',auth()->user->id())->get();
        $tags=Tag::all();
        return view('links.create',compact('categories'));
    }
     public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'url' => 'required|url',
            'category_id' => 'required',
            'tags'=>'array'

        ]);

       $link= Link::create($request->all());
        if($request->has('tags')){
            $link->tags()->attach($request->tags);
        }

        return redirect()->route('links.index')
            ->with('success', 'Lien ajouté');
    }

}
