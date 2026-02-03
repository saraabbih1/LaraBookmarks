<h2>Mes liens</h2>

@foreach($links as $link)
    <p>
        {{ $link->title }} -
        <a href="{{ $link->url }}" target="_blank">Visiter</a>
        ({{ $link->category->name }})
    </p>
@endforeach
