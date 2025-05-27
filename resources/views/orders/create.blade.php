@extends('layouts.app')
@section('title', 'Создать заявку')
@section('content')
<div class="col-lg-7 mx-auto">
    <div class="">
        <h2 class="mb-4 text-center">Новая заявка</h2>
        <form method="POST" action="/orders">
            @csrf
            <div class="mb-3">
                <input type="text" name="address" class="form-control form-control-lg" placeholder="Адрес" value="{{ old('address') }}" required>
                @error('address')<div class="text-danger small">{{ $message }}</div>@enderror
            </div>
            <div class="mb-3">
                <input type="text" name="phone" class="form-control form-control-lg" placeholder="Телефон +7(XXX)-XXX-XX-XX" value="{{ old('phone') }}" required>
                @error('phone')<div class="text-danger small">{{ $message }}</div>@enderror
            </div>
            <div class="mb-3">
                <input type="datetime-local" name="service_time" class="form-control form-control-lg" value="{{ old('service_time') }}" required>
                @error('service_time')<div class="text-danger small">{{ $message }}</div>@enderror
            </div>
            <div class="mb-3">
                <label for="service_id" class="form-label">Вид услуги</label>
                <select name="service_id" id="service_id" class="form-select form-select-lg">
                    <option value="">Иная услуга</option>
                    @foreach($services as $service)
                        <option value="{{ $service->id }}" @if(old('service_id') == $service->id) selected @endif>
                            {{ $service->name }}
                        </option>
                    @endforeach
                </select>
                @error('service_id')<div class="text-danger small">{{ $message }}</div>@enderror
            </div>
            <div class="mb-3" id="other-service-block" style="display: {{ old('service_id') ? 'none' : 'block' }}">
                <input type="text" name="other_service" class="form-control form-control-lg" placeholder="Опишите услугу" value="{{ old('other_service') }}">
                @error('other_service')<div class="text-danger small">{{ $message }}</div>@enderror
            </div>
            <div class="mb-3">
                <label class="form-label">Тип оплаты</label>
                <select name="payment_type" class="form-select form-select-lg" required>
                    <option value="cash" @if(old('payment_type') == 'cash') selected @endif>Наличные</option>
                    <option value="card" @if(old('payment_type') == 'card') selected @endif>Банковская карта</option>
                </select>
                @error('payment_type')<div class="text-danger small">{{ $message }}</div>@enderror
            </div>
            <button type="submit" class="btn btn-success btn-lg w-100">Отправить заявку</button>
        </form>
        <div class="text-center mt-3">
            <a href="{{ route('orders.index') }}" class="btn btn-link">Мои заявки</a>
        </div>
    </div>
</div>
@push('scripts')
<script>
    const serviceSelect = document.getElementById('service_id');
    const otherBlock = document.getElementById('other-service-block');
    serviceSelect.addEventListener('change', function() {
        if(this.value === "") {
            otherBlock.style.display = "block";
        } else {
            otherBlock.style.display = "none";
        }
    });
</script>
@endpush
@endsection
