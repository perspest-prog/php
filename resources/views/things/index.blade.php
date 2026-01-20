@extends('layout')

@section('content')
<ul>
    @foreach ($things as $thing)
        <li @master($thing) @inwork($thing) @inrepair($thing)>
            <a href="{{ route('things.show', $thing) }}">{{ $thing->name }}</a>
            <span> - {{ $thing->description['current'] }}</span>
        </li>
    @endforeach
</ul>
@endsection