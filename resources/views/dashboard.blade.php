@extends('layouts.app')

@section('content')
<div class="container mx-auto p-6">

    <h1 class="text-2xl font-bold mb-6"> LaraBookmarks</h1>

    @foreach($categories as $category)
    <div class="border p-4 mb-4">

        <h3>{{ $category->name }}</h3>

        {{-- Ajouter link --}}
        <form method="POST" action="{{ route('links.store') }}">
            @csrf
            <input type="hidden" name="category_id" value="{{ $category->id }}">

            <input type="text" name="title" placeholder="Titre">
            <input type="text" name="url" placeholder="URL">

            <button type="submit">➕ Ajouter</button>
        </form>

        {{-- Liste des links --}}
        <ul>
            @foreach($category->links as $link)
                <li>
                    <a href="{{ $link->url }}" target="_blank">
                        {{ $link->title }}
                    </a>

                    {{-- Supprimer --}}
                    <form method="POST" action="{{ route('links.destroy', $link->id) }}" style="display:inline">
                        @csrf
                        @method('DELETE')
                        <button>❌</button>
                    </form>
                </li>
            @endforeach
        </ul>

    </div>
@endforeach
