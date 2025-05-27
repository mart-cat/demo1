@extends('layouts.app')
@section('title', 'Регистрация')
@section('content')
<div class="col-lg-8 mx-auto">
    <div class="">
        <h2 class="mb-4 text-center">Регистрация</h2>
        <form method="POST" action="{{ route('register') }}">
            @csrf
            <div class="mb-3">
                <input type="text" name="fio" class="form-control form-control-lg" placeholder="ФИО" value="{{ old('fio') }}" required>
                @error('fio')<div class="text-danger small">{{ $message }}</div>@enderror
            </div>
            <div class="mb-3">
                <input type="text" name="phone" class="form-control form-control-lg" placeholder="Телефон +7(XXX)-XXX-XX-XX" value="{{ old('phone') }}" required>
                @error('phone')<div class="text-danger small">{{ $message }}</div>@enderror
            </div>
            <div class="mb-3">
                <input type="email" name="email" class="form-control form-control-lg" placeholder="Электронная почта" value="{{ old('email') }}" required>
                @error('email')<div class="text-danger small">{{ $message }}</div>@enderror
            </div>
            <div class="mb-3">
                <input type="text" name="login" class="form-control form-control-lg" placeholder="Логин" value="{{ old('login') }}" required>
                @error('login')<div class="text-danger small">{{ $message }}</div>@enderror
            </div>
            <div class="mb-3">
                <input type="password" name="password" class="form-control form-control-lg" placeholder="Пароль (мин. 6 символов)" required>
                @error('password')<div class="text-danger small">{{ $message }}</div>@enderror
            </div>
            <button type="submit" class="btn btn-success btn-lg w-100">Зарегистрироваться</button>
        </form>
    </div>
</div>
@endsection
