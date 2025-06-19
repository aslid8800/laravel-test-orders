@extends('layouts.app')

@section('title', 'Просмотр заказа')

@section('content')
<a href="{{ route('orders.index') }}" class="btn btn-secondary mb-3">← Назад к заказам</a>

<div class="card">
    <div class="card-body">
        <h5 class="card-title">Заказ #{{ $order->id }}</h5>

        <p><strong>ФИО покупателя:</strong> {{ $order->customer_name }}</p>
        <p><strong>Дата создания:</strong> {{ $order->order_date }}</p>
        <p><strong>Комментарий:</strong> {{ $order->comment ?? '—' }}</p>
        <p><strong>Статус:</strong> {{ $order->status }}</p>
        <p><strong>Товар:</strong> {{ $order->product->name }} ({{ number_format($order->product->price / 100, 2, ',', ' ') }} руб.)</p>
        <p><strong>Количество:</strong> {{ $order->quantity }}</p>
        <p><strong>Итоговая сумма:</strong> {{ number_format($order->product->price * $order->quantity / 100, 2, ',', ' ') }} руб.</p>

        @if($order->status !== 'выполнен')
            <form action="{{ route('orders.update', $order->id) }}" method="POST" class="mt-3">
                @csrf
                @method('PUT')
                <input type="hidden" name="status" value="выполнен">
                <button class="btn btn-success">Завершить заказ</button>
            </form>
        @endif
    </div>
</div>
@endsection
