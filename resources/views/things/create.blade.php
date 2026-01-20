@extends('layout')

@section('content')
<form action="{{ route('things.store') }}" method="POST">
    @csrf

    <div class="mb-3">
        <label for="name" class="form-label">Название *</label>
        <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name') }}" required>
        @error('name')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="mb-3">
        <label for="description" class="form-label">Описание</label>
        <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description" rows="4">{{ old('description') }}</textarea>
        @error('description')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="mb-3">
        <label for="wrnt" class="form-label">Гарантия / Срок годности</label>
        <input type="date" class="form-control @error('wrnt') is-invalid @enderror" id="wrnt" name="wrnt" value="{{ old('wrnt') }}" required>
        @error('wrnt')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="mb-3">
        <label for="amount" class="form-label">Количество</label>
        <input type="number" class="form-control @error('amount') is-invalid @enderror" id="amount" name="amount" value="{{ old('amount') }}" required>
        @error('amount')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <button type="submit" class="btn btn-primary">Создать вещь</button>
    <a href="{{ route('things.index') }}" class="btn btn-secondary">Отмена</a>
</form>
@endsection
