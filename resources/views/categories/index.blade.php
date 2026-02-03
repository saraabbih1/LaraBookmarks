@extends('layouts.app')

@section('content')
<h2>Mes catégories</h2>

<form method="POST" action="{{ route('categories.store') }}">
    @csrf
    <input type="text" name="name" placeholder="Nom catégorie">
    <button>Ajouter</button>
</form>

<ul>
@foreach($categories as $category)
    <li>{{ $category->name }}</li>
@endforeach
</ul>
@endsection
