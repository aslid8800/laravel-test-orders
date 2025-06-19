@extends('layouts.app')

@section('title', 'Добавить товар')

@section('content')
<a href="{{ route('products.index') }}" class="btn btn-secondary mb-3">← Назад к списку</a>

<form action="{{ route('products.store') }}" method="POST">
    @csrf

    <div class="mb-3">
        <label class="form-label">Название товара *</label>
        <input type="text" name="name" class="form-control" required value="{{ old('name') }}">
    </div>

    <div class="mb-3">
        <label class="form-label">Категория *</label>
        <select name="category_id" class="form-select" required>
            <option value="">-- выберите категорию --</option>
            @foreach($categories as $category)
                <option value="{{ $category->id }}" @selected(old('category_id') == $category->id)>
                    {{ $category->name }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="mb-3">
        <label class="form-label">Описание</label>
        <textarea name="description" class="form-control">{{ old('description') }}</textarea>
    </div>

    <div class="mb-3">
        <label class="form-label">Цена (в рублях) *</label>
        <input type="number" name="price" class="form-control" required step="0.01" min="0" value="{{ old('price') }}">
        <div class="form-text">Цена хранится в копейках — 100 рублей = 10000</div>
    </div>

    <button class="btn btn-success">Сохранить</button>
</form>
@endsection
