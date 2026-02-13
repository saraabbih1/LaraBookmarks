@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto px-6 py-8 bg-stone-100 min-h-screen">

   
    <div class="flex flex-col lg:flex-row justify-between gap-4 items-center mb-10
                bg-gradient-to-r from-amber-700 to-amber-500
                text-white rounded-2xl p-6 shadow-lg">

        <h1 class="text-3xl font-extrabold tracking-wide">
             LaraBookmarks
        </h1>
<div class="flex gap-3">
    <!-- ADD CATEGORY -->
    <a href="{{ route('categories.create') }}"
       class="bg-indigo-600 hover:bg-indigo-500 text-white
              px-4 py-2 rounded-lg shadow font-semibold">
        + Catégorie
    </a>

    <!-- ADD TAG -->
    <a href="{{ route('tags.create') }}"
       class="bg-emerald-600 hover:bg-emerald-500 text-white
              px-4 py-2 rounded-lg shadow font-semibold">
        + Tag
    </a>
</div>

        {{-- FILTER --}}
        <x-validation-errors />
        <form method="GET" action="{{ route('dashboard') }}"
              class="flex gap-3 items-center bg-white/20 p-3 rounded-xl backdrop-blur">

            <select name="category"
                    class="rounded-lg px-3 py-2 text-zinc-700 focus:ring-2 focus:ring-amber-500">
                <option value="">Toutes catégories</option>
                @foreach($categories as $cat)
                    <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                @endforeach
            </select>

            <select name="tag"
                    class="rounded-lg px-3 py-2 text-zinc-700 focus:ring-2 focus:ring-amber-500">
                <option value="">Tous tags</option>
                @foreach($tags as $tag)
                    <option value="{{ $tag->id }}">{{ $tag->name }}</option>
                @endforeach
            </select>

            <button class="bg-amber-600 hover:bg-amber-500 text-white px-4 py-2 rounded-lg">
                Filtrer
            </button>
        </form>

        {{-- LOGOUT --}}
        <x-validation-errors />
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button class="bg-red-500 hover:bg-red-600 px-5 py-2 rounded-lg shadow">
                Logout
            </button>
        </form>
    </div>

   
    @if(session('success'))
        <div class="mb-8 bg-green-100 border border-green-300 text-green-800
                    px-5 py-3 rounded-xl shadow">
            {{ session('success') }}
        </div>
    @endif

   
    <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-8">

        @foreach($categories as $category)
        <div class="bg-white rounded-2xl p-6 shadow-md hover:shadow-xl transition">

         
           <div class="flex justify-between items-center mb-5">
    <h2 class="text-2xl font-bold text-indigo-600">
        {{ $category->name }}
    </h2>
<x-validation-errors />
    <form method="POST"
          action="{{ route('categories.destroy', $category->id) }}"
          onsubmit="return confirm('wach mtaakd bghiti tmssh catégorie ?')">
        @csrf
        @method('DELETE')

        <button class="text-red-500 hover:text-red-700 text-sm font-semibold">
            Supprimer
        </button>
    </form>
</div>


        <x-validation-errors />
            <form method="POST" action="{{ route('links.store') }}"
                  class="grid grid-cols-1 md:grid-cols-3 gap-3 mb-5">
                @csrf
                <input type="hidden" name="category_id" value="{{ $category->id }}">

                <input type="text" name="title" placeholder="Titre"
                       class="border rounded-lg px-3 py-2 focus:ring-2 focus:ring-amber-400"
                       required>

                <input type="url" name="url" placeholder="URL"
                       class="border rounded-lg px-3 py-2 focus:ring-2 focus:ring-amber-400"
                       required>
                       <div class="col-span-3 flex flex-wrap gap-2">
    @foreach($tags as $tag)
        <label class="flex items-center gap-1 text-sm">
            <input type="checkbox" name="tags[]" value="{{ $tag->id }}">
            {{ $tag->name }}
        </label>
    @endforeach
</div>


                <button class="bg-amber-100 hover:bg-amber-200 text-amber-800
                               rounded-lg font-semibold">
                    + Ajouter
                </button>
            </form>

          
            @if($category->links->count())
                <ul class="space-y-3">
                    @foreach($category->links as $link)
                    <li class="flex justify-between items-center bg-stone-50
                               px-4 py-2 rounded-xl hover:bg-stone-100 transition">

                        <a href="{{ $link->url }}" target="_blank"
                           class="text-zinc-700 font-medium hover:text-amber-700 truncate">
                             {{ $link->title }}
                        </a>
        <div class="flex gap-1 flex-wrap mt-1">
    @foreach($link->tags as $tag)
        <span class="bg-amber-100 text-amber-800 text-xs px-2 py-1 rounded-full">
            #{{ $tag->name }}
        </span>
    @endforeach
</div>
                        <x-validation-errors />
                        <form method="POST" action="{{ route('links.destroy', $link->id) }}">
                            @csrf
                            @method('DELETE')
                            <button class="text-red-500 hover:text-red-700">
                                supprimer
                            </button>
                        </form>
                    </li>
                    @endforeach
                </ul>
            @else
                <p class="text-zinc-400 italic text-sm">
                    Aucun lien pour cette catégorie.
                </p>
            @endif

        </div>
        @endforeach

    </div>

  
    <div class="mt-16 text-center text-zinc-400 text-sm">
        LaraBookmarks © 2026 – Built with  & Laravel
    </div>

</div>
@endsection
