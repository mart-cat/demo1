@extends('layouts.app')
@section('title', 'Вход')
@section('content')
<div class="col-lg-6 mx-auto">
    <div class=" shadow-sm">
        <h2 class=" text-center">Вход</h2>
        <form method="POST" action="{{ route('login') }}">
            @csrf
            <div class="mb-3">
                <input type="text" name="login" class="form-control form-control-lg" placeholder="Логин" required>
                @error('login')<div class="text-danger small">{{ $message }}</div>@enderror
            </div>
            <div class="mb-3">
                <input type="password" name="password" class="form-control form-control-lg" placeholder="Пароль" required>
                @error('password')<div class="text-danger small">{{ $message }}</div>@enderror
            </div>
            <button type="submit" class="btn btn-success btn-lg w-100">Войти</button>
        </form>
    </div>
</div>
@endsection
