@extends('layout')

@section('content')
<div class="register-box">
    <h2 style="text-align: center;">Регистрация</h2>
    <form method="POST" action="{{ route('register') }}">
        @csrf

        <input type="text" name="name" placeholder="Имя" value="{{ old('name') }}" required>
        <input type="email" name="email" placeholder="Email" value="{{ old('email') }}" required>
        <input type="password" name="password" placeholder="Пароль (мин. 8 символов)" required>
        <button type="submit">Зарегистрироваться</button>
    </form>

    <a href="{{ route('login') }}" class="link">Уже есть аккаунт? Войти</a>
</div>
@endsection