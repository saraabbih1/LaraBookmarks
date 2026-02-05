@extends('layouts.app')

@section('content')
<div class="container mx-auto p-6">

    
    <div class="flex justify-between items-center mb-6 bg-gradient-to-r from-indigo-500 to-purple-500 text-white rounded-xl p-4 shadow">
        <h1 class="text-2xl font-bold flex items-center gap-2"> LaraBookmarks Dashboard</h1>

        {{-- Filtrage --}}
        <form method="GET" action="{{ route('dashboard') }}" class="flex gap-2 items-center">
            <select name="category" class="rounded px-2 py-1">
                <option value="">Toutes catégories</option>
                @foreach($categories as $cat)
                    <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                @endforeach
            </select>

            <select name="tag" class="rounded px-2 py-1">
                <option value="">Tous tags</option>
                @foreach($tags as $tag)
                    <option value="{{ $tag->id }}">{{ $tag->name }}</option>
                @endforeach
            </select>

            <button type="submit" class="bg-white text-indigo-600 px-3 py-1 rounded hover:bg-gray-100 transition">Filtrer</button>
        </form>

       
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded transition">Logout</button>
        </form>
    </div>

    @if(session('success'))
        <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6 shadow">
            {{ session('success') }}
        </div>
    @endif

    {{-- ===== CATEGORIES ===== --}}
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach($categories as $category)
            <div class="border rounded-xl p-5 bg-white shadow hover:shadow-lg transition-shadow duration-300">

                {{-- nom catégorie --}}
                <h2 class="text-xl font-semibold mb-3 flex justify-between items-center text-indigo-600">
                    <span>-{{ $category->name }}</span>
                    <span class="text-gray-400 text-sm">{{ $category->links->count() }} liens</span>
                </h2>

                {{-- AJOUT LINK  --}}
                <form method="POST" action="{{ route('links.store') }}" class="mb-4 flex flex-col sm:flex-row gap-2">
                    @csrf
                    <input type="hidden" name="category_id" value="{{ $category->id }}">

                    <input type="text" name="title" placeholder="Titre"
                           class="border rounded px-2 py-1 flex-1 focus:ring-2 focus:ring-indigo-300" required>

                    <input type="url" name="url" placeholder="URL"
                           class="border rounded px-2 py-1 flex-1 focus:ring-2 focus:ring-indigo-300" required>

                    <button class="bg-indigo-500 hover:bg-indigo-600 text-white px-4 py-1 rounded shadow transition">
                        + Ajouter
                    </button>
                </form>

                {{--  LISTE LINKS  --}}
                @if($category->links->count())
                    <ul class="space-y-2">
                        @foreach($category->links as $link)
                            <li class="flex justify-between items-center bg-gray-50 p-2 rounded shadow-sm hover:bg-gray-100 transition-colors">

                               
                                <a href="{{ $link->url }}" target="_blank"
                                   class="text-indigo-600 font-medium hover:underline">
                                    {{ $link->title }}
                                </a>

                               
                                <div class="flex gap-2">
                                    
                                    <form method="POST" action="{{ route('links.destroy', $link->id) }}">
                                        @csrf
                                        @method('DELETE')
                                        <button class="text-red-500 hover:text-red-700"> Supprimer</button>
                                    </form>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                @else
                    <p class="text-gray-400 italic">Aucun lien pour cette catégorie.</p>
                @endif

            </div>
        @endforeach
    </div>

    
    <div class="mt-10 text-center text-gray-500 text-sm">
        LaraBookmarks - 2026
    </div>

</div>
@endsection
