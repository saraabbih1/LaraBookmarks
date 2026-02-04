@extends('layouts.app')

@section('content')
<div class="container mx-auto p-6">
    <h2 class="text-2xl font-bold mb-4">Mes catégories</h2>

    <!-- Formulaire pour ajouter une catégorie -->
    <form method="POST" action="{{ route('categories.store') }}" class="mb-6 flex gap-2">
        @csrf
        <input 
            type="text" 
            name="name" 
            placeholder="Nom catégorie" 
            class="border rounded px-3 py-2 w-full"
            required
        >
        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
            Ajouter
        </button>
    </form>

    <!-- Message de succès -->
    @if(session('success'))
        <div class="bg-green-100 text-green-800 px-4 py-2 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <!-- Liste des catégories -->
    <ul class="border rounded divide-y">
        @forelse($categories as $category)
            <li class="px-4 py-2 hover:bg-gray-100 flex justify-between items-center">
                {{ $category->name }}
                <!-- Bouton supprimer -->
                <form action="{{ route('categories.destroy', $category->id) }}" method="POST" onsubmit="return confirm('Supprimer cette catégorie ?');">
                    @csrf
                    @method('DELETE')
                    <button class="text-red-500 hover:text-red-700">Supprimer</button>
                </form>
            </li>
        @empty
            <li class="px-4 py-2 text-gray-500">Aucune catégorie trouvée.</li>
        @endforelse
    </ul>
</div>
@endsection
