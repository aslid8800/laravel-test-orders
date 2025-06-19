@extends('layouts.app')

@section('title', 'Список товаров')

@section('content')
<a href="{{ route('products.create') }}" class="btn btn-primary mb-3">Добавить товар</a>

<table class="table table-bordered">
    <thead>
        <tr>
            <th>ID</th>
            <th>Название</th>
            <th>Категория</th>
            <th>Цена (руб)</th>
            <th>Действия</th>
        </tr>
    </thead>
    <tbody>
        @foreach($products as $product)
        <tr>
            <td>{{ $product->id }}</td>
            <td>{{ $product->name }}</td>
            <td>{{ $product->category->name ?? '—' }}</td>
            <td>{{ number_format($product->price / 100, 2, ',', ' ') }}</td>
            <td>
                <a href="{{ route('products.show', $product->id) }}" class="btn btn-sm btn-info">Просмотр</a>
                <a href="{{ route('products.edit', $product->id) }}" class="btn btn-sm btn-warning">Редактировать</a>
                <form action="{{ route('products.destroy', $product->id) }}" method="POST" class="d-inline">
                    @csrf @method('DELETE')
                    <button class="btn btn-sm btn-danger" onclick="return confirm('Удалить товар?')">Удалить</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection
