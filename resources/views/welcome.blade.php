@extends('layouts.app')
@section('title', 'Мой Не Сам')
@section('content')
<div class="text-center p-5">
    <h1 class="display-4 mb-4">Портал клининговых услуг<br>«Мой Не Сам»</h1>
    <p class="lead mb-5">Быстрая и удобная подача заявок на уборку квартир, домов и производственных помещений.</p>
    <div class="d-flex flex-wrap justify-content-center gap-3 mb-4">
        <a href="/login" class="btn btn-success btn-lg px-5">Войти</a>
        <a href="/register" class="btn btn-outline-primary btn-lg px-5">Регистрация</a>
    </div>
    <div>
        <a href="#about" data-bs-toggle="collapse" class="text-secondary small">О сервисе</a>
        <div id="about" class="collapse text-start mt-3 small">
            <b>«Мой Не Сам»</b> — сервис для подачи заявок на уборку: просто зарегистрируйтесь, выберите услугу, укажите удобное время — и мы всё сделаем за вас!
        </div>
    </div>
</div>
@endsection
