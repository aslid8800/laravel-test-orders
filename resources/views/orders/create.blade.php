@extends('layouts.app')

@section('title', 'Создать заказ')

@section('content')
<a href="{{ route('orders.index') }}" class="btn btn-secondary mb-3">← Назад к заказам</a>

<form action="{{ route('orders.store') }}" method="POST">
    @csrf

    <div class="mb-3">
        <label class="form-label">ФИО покупателя *</label>
        <input type="text" name="customer_name" class="form-control" required value="{{ old('customer_name') }}">
    </div>

    <div class="mb-3">
        <label class="form-label">Дата создания *</label>
        <input type="date" name="order_date" class="form-control" required value="{{ old('order_date', date('Y-m-d')) }}">
    </div>

    <div class="mb-3">
        <label class="form-label">Товар *</label>
        <select name="product_id" class="form-select" required>
            <option value="">-- выберите товар --</option>
            @foreach($products as $product)
                <option value="{{ $product->id }}" @selected(old('product_id') == $product->id)>
                    {{ $product->name }} ({{ number_format($product->price / 100, 2, ',', ' ') }} руб.)
                </option>
            @endforeach
        </select>
    </div>

    <div class="mb-3">
        <label class="form-label">Количество *</label>
        <input type="number" name="quantity" class="form-control" required min="1" value="{{ old('quantity', 1) }}">
    </div>

    <div class="mb-3">
        <label class="form-label">Комментарий</label>
        <textarea name="comment" class="form-control">{{ old('comment') }}</textarea>
    </div>

    <button class="btn btn-success">Сохранить заказ</button>
</form>
@endsection
