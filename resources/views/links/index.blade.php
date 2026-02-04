@extends('layouts.app')

@section('content')
<h2>Mes liens</h2>

@foreach($links as $link)
    <p>
        <strong>{{ $link->title }}</strong> |
        <a href="{{ $link->url }}">{{ $link->url }}</a>
        <br>
        Tags:
        @foreach($link->tags as $tag)
            <span>#{{ $tag->name }}</span>
        @endforeach
    </p>
@endforeach
@endsection
