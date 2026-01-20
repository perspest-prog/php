@extends('layout')

@section('content')
  <h2>Список архивных вещей</h2>
  <ul>
    @foreach ($archiveThings as $archiveThing)
        <form action="{{ route('archive.update', $archiveThing) }}" method="POST">
          @csrf
          @method('PUT')

          <input type="text" readonly name="{{ $archiveThing->name }}" value="{{ $archiveThing->name }}">
          <input type="text" readonly name="{{ $archiveThing->description }}" value="{{ $archiveThing->description }}">
          <input type="text" readonly name="{{ $archiveThing->wrnt }}" value="{{ $archiveThing->wrnt }}">
          <input type="text" readonly name="{{ $archiveThing->amount }}" value="{{ $archiveThing->amount }}">
          <input type="text" readonly name="{{ $archiveThing->master }}" value="{{ $archiveThing->master }}">
          @if ($archiveThing->is_restored === 0)
            <button type="submit">Восстановить</button>
          @else
            <span>Восстановлено</span>
          @endif
        </form>
        <hr>
    @endforeach
  </ul>
@endsection