@extends('layout')

@section('content')
<ul>
    @foreach ($places as $place)
        <li>
            <span>{{ $place->name }}</span>
            <a href="{{ route("places.show", $place) }}">Просмотреть запись</a>
        </li>
    @endforeach
    <a href="{{ route("places.create") }}">Создать запись</a>
</ul>
@endsection 