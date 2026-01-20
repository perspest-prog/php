@extends("layout")

@section('content')
  <form method="POST" action="{{ route("places.store") }}">
    @csrf
    <input name="name" type="text" placeholder="name">
    <input name="description" type="text" placeholder="description">
    <label>repair</label><input name="repair" id="repair" type="checkbox" value="0">
    <label>work</label><input name="work" id="work" type="checkbox" value="0">
    <button type="submit">Добавить запись</button>
  </form>
@endsection