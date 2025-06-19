@extends('layouts.app')

@section('title', 'Редактировать товар')

@section('content')
<a href="{{ route('products.index') }}" class="btn btn-secondary mb-3">← Назад</a>

<form action="{{ route('products.update', $product->id) }}" method="POST">
    @csrf
    @method('PUT')

    <div class="mb-3">
        <label class="form-label">Название товара *</label>
        <input type="text" name="name" class="form-control" required value="{{ old('name', $product->name) }}">
    </div>

    <div class="mb-3">
        <label class="form-label">Категория *</label>
        <select name="category_id" class="form-select" required>
            @foreach($categories as $category)
                <option value="{{ $category->id }}" @selected(old('category_id', $product->category_id) == $category->id)>
                    {{ $category->name }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="mb-3">
        <label class="form-label">Описание</label>
        <textarea name="description" class="form-control">{{ old('description', $product->description) }}</textarea>
    </div>

    <div class="mb-3">
        <label class="form-label">Цена (в рублях) *</label>
        <input type="number" name="price" class="form-control" required step="0.01" min="0" value="{{ old('price', $product->price / 100) }}">
    </div>

    <button class="btn btn-success">Обновить</button>
</form>
@endsection
