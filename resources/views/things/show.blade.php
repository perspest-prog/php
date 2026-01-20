@extends('layout')

@section('content')
    <h1>{{ $thing->name }}</h1>
    <p>{{ $thing->description['current'] }} - Актуальное описание</p>
    <ul>Все описания:
        @foreach ($thing->description['variants'] as $description)
            <li>{{ $description }}</li>
        @endforeach
    </ul>
    <a href="{{ route('usages.create', ['thing_id' => $thing->id]) }}">
        Передать вещь
    </a>
    <a href="{{ route('things.edit', $thing) }}">
        Изменить вещь
    </a>
    <form action="{{ route("things.destroy", $thing) }}" method="POST">
        @CSRF
        @method('DELETE')
        
        <button type="submit">Удалить запись</button>
    </form>
@endsection