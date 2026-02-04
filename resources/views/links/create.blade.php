<form method="POST" action="{{ route('links.store') }}">
    @csrf

    <input type="text" name="title" placeholder="Titre"><br>
    <input type="text" name="url" placeholder="URL"><br>

    <select name="category_id">
        @foreach($categories as $cat)
            <option value="{{ $cat->id }}">{{ $cat->name }}</option>
        @endforeach
    </select>
    <select name="tags[]" multiple>
        @foreach($tags as $tag)
        <option value="{{$tag->id}}">{{$tag->name}}</option>
        @endforeach
    </select>

    <button>Ajouter</button>
</form>
