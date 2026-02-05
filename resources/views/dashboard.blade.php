@extends('layouts.app')

@section('content')
<div class="container mx-auto p-6">

    {{-- Titre --}}
    <h1 class="text-3xl font-bold mb-6"> LaraBookmarks Dashboard</h1>

    {{-- Message succès --}}
    @if(session('success'))
        <div class="bg-green-100 text-green-800 p-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    {{-- ===== CATEGORIES ===== --}}
    @foreach($categories as $category)
        <div class="border rounded p-4 mb-6 bg-white shadow">

            {{-- Nom catégorie --}}
            <h2 class="text-xl font-semibold mb-3">
                -{{ $category->name }}
            </h2>

            {{-- ===== AJOUT LINK ===== --}}
            <form method="POST" action="{{ route('links.store') }}" class="mb-4 flex gap-2">
                @csrf

                <input type="hidden" name="category_id" value="{{ $category->id }}">

                <input type="text" name="title" placeholder="Titre"
                       class="border rounded px-2 py-1 w-1/4" required>

                <input type="url" name="url" placeholder="URL"
                       class="border rounded px-2 py-1 w-1/2" required>

                <button class="bg-blue-500 text-white px-3 py-1 rounded">
                    + Ajouter
                </button>
            </form>

            {{-- ===== LISTE LINKS ===== --}}
            @if($category->links->count())
                <ul class="space-y-2">
                    @foreach($category->links as $link)
                        <li class="flex justify-between items-center border-b pb-1">

                            {{-- Lien --}}
                            <a href="{{ $link->url }}" target="_blank"
                               class="text-blue-600 hover:underline">
                                🔗 {{ $link->title }}
                            </a>

                            {{-- Actions --}}
                            <div class="flex gap-2">

                                {{-- Supprimer --}}
                                <form method="POST" action="{{ route('links.destroy', $link->id) }}">
                                    @csrf
                                    @method('DELETE')
                                    <button class="text-red-600">🗑</button>
                                </form>

                            </div>
                        </li>
                    @endforeach
                </ul>
            @else
                <p class="text-gray-500">Aucun lien pour cette catégorie.</p>
            @endif

        </div>
    @endforeach

</div>
@endsection
