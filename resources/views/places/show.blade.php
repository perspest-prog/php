@extends('layout')

@section('content')
<span>{{ $place->name }}</span>
<a href="{{ route("places.edit", $place) }}">Редактировать запись</a>
<form action="{{ route("places.destroy", $place) }}" method="POST">
    @CSRF
    @method('DELETE')
    <button type="submit">Удалить запись</button>
</form>
@endsection