@extends('layouts.app')

@section('title', 'Информация о товаре')

@section('content')
<a href="{{ route('products.index') }}" class="btn btn-secondary mb-3">← Назад</a>

<div class="card">
    <div class="card-body">
        <h5 class="card-title">{{ $product->name }}</h5>
        <p><strong>Категория:</strong> {{ $product->category->name ?? '—' }}</p>
        <p><strong>Описание:</strong> {{ $product->description ?? '—' }}</p>
        <p><strong>Цена:</strong> {{ number_format($product->price / 100, 2, ',', ' ') }} руб.</p>

        <a href="{{ route('products.edit', $product->id) }}" class="btn btn-warning">Редактировать</a>
    </div>
</div>
@endsection
