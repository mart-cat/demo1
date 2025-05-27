@extends('layouts.app')
@section('title', 'Админ-панель')
@section('content')
    <h2 class="mb-4 text-center">Все заявки</h2>
    @if ($orders->count())
        <table class="table table-hover align-middle">
            <thead>
                <tr>
                    <th>ФИО</th>
                    <th>Контакты</th>
                    <th>Адрес</th>
                    <th>Услуга</th>
                    <th>Время</th>
                    <th>Оплата</th>
                    <th>Статус</th>
                    <th>Действия</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($orders as $order)
                    <tr>
                        <td>{{ $order->user->fio }}</td>
                        <td>
                            <div>{{ $order->user->phone }}</div>
                            <div class="small text-muted">{{ $order->user->email }}</div>
                        </td>
                        <td>{{ $order->address }}</td>
                        <td>{{ $order->service->name ?? $order->other_service }}</td>
                        <td>{{ $order->service_time }}</td>
                        <td>{{ $order->payment_type === 'card' ? 'Карта' : 'Наличные' }}</td>
                        <td>
                            @if ($order->status === 'new')
                                <span class="badge bg-warning text-dark">Новая</span>
                            @elseif($order->status === 'in_progress')
                                <span class="badge bg-info text-dark">В работе</span>
                            @elseif($order->status === 'done')
                                <span class="badge bg-success">Выполнено</span>
                            @else
                                <span class="badge bg-danger">Отменено</span>
                            @endif
                            @if ($order->status === 'cancelled' && $order->cancel_reason)
                                <div class="text-danger small">{{ $order->cancel_reason }}</div>
                            @endif
                        </td>
                        <td>
                            <form method="POST" action="{{ route('admin.updateStatus', $order->id) }}"
                                class="d-flex align-items-center gap-2">
                                @csrf
                                <select name="status" class="form-select form-select-sm" style="width:auto;"
                                    onchange="toggleReasonField(this, {{ $order->id }})" required>
                                    <option value="in_progress" @if ($order->status == 'in_progress') selected @endif>В работе
                                    </option>
                                    <option value="done" @if ($order->status == 'done') selected @endif>Выполнено
                                    </option>
                                    <option value="cancelled" @if ($order->status == 'cancelled') selected @endif>Отменено
                                    </option>
                                </select>
                                <input type="text" name="cancel_reason" class="form-control form-control-sm"
                                    placeholder="Причина отмены" id="reason-block-{{ $order->id }}"
                                    style="width: 140px; display: none;" value="{{ $order->cancel_reason }}">
                                <button type="submit" class="btn btn-outline-primary btn-sm">ОК</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <div class="alert alert-secondary text-center">Нет заявок</div>
    @endif
    @push('scripts')
        <script>
            function toggleReasonField(select, id) {
                let reasonBlock = document.getElementById('reason-block-' + id);
                if (select.value === 'cancelled') {
                    reasonBlock.style.display = 'block';
                } else {
                    reasonBlock.style.display = 'none';
                }
            }

            const x = [1, 2]
            // инициализация для уже отменённых заявок
            document.querySelectorAll('select[name="status"]').forEach(function(sel) {
                toggleReasonField(sel, sel.closest('form').action.match(/\d+/)[0]);
            });
        </script>
    @endpush
@endsection
