@extends('layouts.app')

@section('title', 'Список заказов')

@section('content')
<a href="{{ route('orders.create') }}" class="btn btn-primary mb-3">Создать заказ</a>

<table class="table table-bordered">
    <thead>
        <tr>
            <th>ID</th>
            <th>Дата</th>
            <th>Покупатель</th>
            <th>Статус</th>
            <th>Итоговая цена</th>
            <th>Действия</th>
        </tr>
    </thead>
    <tbody>
        @foreach($orders as $order)
        <tr>
            <td>{{ $order->id }}</td>
            <td>{{ $order->order_date }}</td>
            <td>{{ $order->customer_name }}</td>
            <td>{{ $order->status }}</td>
            <td>{{ number_format($order->product->price * $order->quantity / 100, 2, ',', ' ') }} руб.</td>
            <td>
                <a href="{{ route('orders.show', $order->id) }}" class="btn btn-sm btn-info">Просмотр</a>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection
