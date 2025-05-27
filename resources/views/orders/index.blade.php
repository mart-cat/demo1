@extends('layouts.app')
@section('title', 'Мои заявки')
@section('content')
<div class="mb-4">
    <a href="{{ route('orders.create') }}" class="btn btn-primary btn-lg">Создать заявку</a>
</div>
@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif
@if($orders->count())
    <div class="row g-4">
        @foreach($orders as $order)
            <div class="col-lg-6">
                <div class="card shadow-sm h-100">
                    <div class="card-body">
                        <div><b>Услуга:</b> {{ $order->service->name ?? $order->other_service }}</div>
                        <div><b>Статус:</b>
                            @if($order->status === 'new') <span class="badge bg-warning text-dark">Новая</span>
                            @elseif($order->status === 'in_progress') <span class="badge bg-info text-dark">В работе</span>
                            @elseif($order->status === 'done') <span class="badge bg-success">Выполнено</span>
                            @else <span class="badge bg-danger">Отменено</span> @endif
                        </div>
                        <div><b>Время:</b> {{ $order->service_time }}</div>
                        <div><b>Оплата:</b> {{ $order->payment_type === 'card' ? 'Банковская карта' : 'Наличные' }}</div>
                        @if($order->status === 'cancelled' && $order->cancel_reason)
                            <div class="text-danger small"><b>Причина отмены:</b> {{ $order->cancel_reason }}</div>
                        @endif
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@else
    <div class="alert alert-secondary text-center">Заявок пока нет</div>
@endif
@endsection
