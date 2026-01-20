@extends("layout")
@section('content')
  <h1>Передать: {{ $thing->name }}</h1>
  
  <form method="POST" action="{{ route("usages.store") }}">
    @csrf

    <input type="hidden" name="thing_id" value="{{ $thing->id }}">

    <label>Кому передать:</label>
    <select name="user_id">
      @foreach ($users as $user)
        <option value="{{ $user->id }}">
            {{ $user->name }}
        </option>
      @endforeach
    </select>

    <label>Место хранения:</label>
    <select name="place_id">
      @foreach ($places as $place)
        <option value="{{ $place->id }}">
            {{ $place->name }}
        </option>
      @endforeach
    </select>

    <label>Количество:</label>
    <input type="number" name="amount" min="0" max="{{ $thing->amount }}" value="{{ $thing->amount }}">
    <button type="submit">Сохранить</button>
  </form>
@endsection