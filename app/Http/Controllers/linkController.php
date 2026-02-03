<?php
namespace App\Http\Controllers;
use App\Models\Link;
use App\Models\Category;


use Illuminate\Http\Request;

class linkController extends Controller
{
    public function index(){
        $links = Link::wherehas('category',function($q){
            $q->where('user_id',auth()->user->id());
        })->get();
        return view('links.index',compact('links'));
    }
    public function create(){
        $categories=Category::where('user_id',auth()->user->id())->get();
        return view('links.create',compact('categories'));
    }
     public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'url' => 'required|url',
            'category_id' => 'required'
        ]);

        Link::create($request->all());

        return redirect()->route('links.index')
            ->with('success', 'Lien ajouté');
    }

}
