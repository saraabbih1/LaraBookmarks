<?php

namespace App\Http\Controllers;


use App\Models\Tag;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\Link;
use App\Policies\LinkPolicy;

class LinkController extends Controller
{
    
    public function index(Request $request)
    {
        $query = Link::query();

        // Limiter aux links de l'utilisateur connecté
        $query->whereHas('category', function($q){
            $q->where('user_id', auth()->id());
        });

        // Filtrage par catégorie
        if ($request->filled('category_id')) {
            $query->where('category_id', $request->category_id);
        }

        // Filtrage par tag
        if ($request->filled('tag_id')) {
            $query->whereHas('tags', function($q) use ($request) {
                $q->where('tags.id', $request->tag_id);
            });
        }

        // Recherche par titre
        if ($request->filled('search')) {
            $query->where('title', 'like', '%' . $request->search . '%');
        }

        $links = $query->get();
        $categories = Category::where('user_id', auth()->id())->get();
        $tags = Tag::all();

        return view('links.index', compact('links','categories','tags'));
    }

    /**
     * Afficher le formulaire pour créer un lien
     */
    public function create()
    {
        $categories = Category::where('user_id', auth()->id())->get();
        $tags = Tag::all();

        return view('links.create', compact('categories','tags'));
    }

    /**
     * Stocker un nouveau lien
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'url' => 'required|url',
            'category_id' => 'required',
            'tags' => 'array'
        ]);

        $link = Link::create([
            'title' => $request->title,
            'url' => $request->url,
            'category_id' => $request->category_id,
            'user_id'=>auth()->id(),
        ]);

        if($request->has('tags')) {
            $link->tags()->attach($request->tags);
        }

        return redirect()->route('links.index')
                         ->with('success', 'Lien ajouté avec succès !');
    }
  

public function update(Link $link)
{
    $this->authorize('update', $link);
    }

    /**
     * Supprimer un lien
     */
    public function destroy(Link $link)
{
    $this->authorize('delete', $link);

    $link->tags()->detach();
    $link->delete();

    return back()->with('success', 'Lien supprimé avec succès !');
}

}
