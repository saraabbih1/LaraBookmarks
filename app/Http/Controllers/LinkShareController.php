<?php

namespace App\Http\Controllers;
use app\Models\Link;
use app\Http\Controllers\LinkController;
use Illuminate\Http\Request;

class LinkShareController extends Controller
{
    public function store(Request $request, Link $link ){
        $this->authorize('share', $link);

    $request->validate([
        'user_id' => 'required|exists:users,id',
        'permission' => 'required|in:read,edit'
    ]);

    $link->users()->syncWithoutDetaching([
        $request->user_id => ['permission' => $request->permission]
    ]);

    return back()->with('success', 'Lien partagé');
    }
}
