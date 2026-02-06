@extends('layouts.app')

@section('content')
<div class="max-w-md mx-auto mt-20 bg-white p-6 rounded-xl shadow">
    <h2 class="text-2xl font-bold mb-6 text-indigo-600">
        Ajouter une catégorie
    </h2>

    <form method="POST" action="{{ route('categories.store') }}">
        @csrf
        <input type="text" name="name"
               class="w-full border rounded-lg px-3 py-2 mb-4"
               placeholder="Nom catégorie" required>

        <button class="bg-indigo-600 text-white px-4 py-2 rounded-lg">
            Ajouter
        </button>
    </form>
</div>
@endsection
