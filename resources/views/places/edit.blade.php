@extends('layout')

@section('content')
<h1>Редактировать место: {{ $place->name }}</h1>

@if ($errors->any())
    <ul>
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
@endif

<form action="{{ route('places.update', $place) }}" method="POST">
    @csrf
    @method('PUT')

    <label for="name">Название *</label>
    <input type="text" id="name" name="name" value="{{ old('name', $place->name) }}" required>
    @error('name')
        <div>{{ $message }}</div>
    @enderror

    <br>

    <label for="description">Описание *</label>
    <textarea id="description" name="description" rows="4" required>{{ old('description', $place->description) }}</textarea>
    @error('description')
        <div>{{ $message }}</div>
    @enderror

    <br>

    <input type="hidden" name="repair" value="0">
    <input type="checkbox" id="repair" name="repair" value="1" {{ old('repair', $place->repair) ? 'checked' : '' }}>
    <label for="repair">Находится в ремонте</label>

    <br>

    <input type="hidden" name="work" value="0">
    <input type="checkbox" id="work" name="work" value="1" {{ old('work', $place->work) ? 'checked' : '' }}>
    <label for="work">Находится в работе</label>

    <br>

    <button type="submit">Обновить место</button>
    <a href="{{ route('places.index') }}">Отмена</a>
</form>
@endsectionя