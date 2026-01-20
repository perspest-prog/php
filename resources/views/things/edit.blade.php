@extends('layout')

@section('content')
<div class="container mt-4">
    <h1>Редактировать вещь: {{ $thing->name }}</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('things.update', $thing) }}" method="POST">
        @csrf
        @method('PUT')

        <div>
            <label for="name">Название *</label>
            <input type="text" id="name" name="name" value="{{ old('name', $thing->name) }}" required>
            @error('name')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div>
            <h2>Поменять описание</h2>
            @foreach ($thing->description['variants'] as $description)
                <label>
                    <span>{{ $description }}</span>
                    @if ($description == $thing->description['current'])
                        <input type="radio" name="current_description" value="{{ $description }}" checked>
                    @else
                        <input type="radio" name="current_description" value="{{ $description }}">
                    @endif
                </label>
                <br>
            @endforeach
        </div>
        <div>
            <h2>Добавить новое описание</h2>
            <input type="text" name="new_description">
            <br>
        </div>
        <div>
            <label for="wrnt">Гарантия / Срок годности</label>
            <input type="date" class="form-control @error('wrnt') is-invalid @enderror" id="wrnt" name="wrnt" value="{{ old('wrnt', $thing->wrnt) }}">
            @error('wrnt')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
            <small class="form-text text-muted">Если это срок в годах — введите текст в поле "Описание".</small>
        </div>

        <button type="submit" class="btn btn-primary">Обновить вещь</button>
        <a href="{{ route('things.index') }}" class="btn btn-secondary">Отмена</a>
    </form>
</div>
@endsection