@extends('layout')

@section('content')
<div class="login-box">

        <h2 style="text-align: center;">Вход</h2>
        <form method="POST" action="{{ route('login') }}">
            @csrf

            <input type="email" name="email" placeholder="Email" value="{{ old('email') }}" required>
            <input type="password" name="password" placeholder="Пароль" required>
            <button type="submit">Войти</button>
        </form>
</div>
@endsection