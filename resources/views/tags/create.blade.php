@extends('layouts.app')

@section('content')
<div class="max-w-md mx-auto mt-20 bg-white p-8 rounded-2xl shadow">

    <h2 class="text-2xl font-bold mb-6 text-emerald-600">
        Ajouter un tag
    </h2>

    <form method="POST" action="{{ route('tags.store') }}">
        @csrf

        <input type="text" name="name" placeholder="Nom du tag"
               class="w-full border rounded-lg px-4 py-3 mb-4 focus:ring-2 focus:ring-emerald-400"
               required>

        <button class="bg-emerald-600 hover:bg-emerald-500 text-white
                       px-6 py-3 rounded-lg font-semibold">
            Ajouter
        </button>
    </form>

</div>
@endsection
