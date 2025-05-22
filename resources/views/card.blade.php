@extends('layouts.app')
@section('title', $product->exists ? 'Товар #' . $product->id : 'Создание товара' )
@section('content')
    <form method="POST"  action="{{ $product->exists ? route('catalog.update', $product) : route('catalog.store') }}" class="max-w-xl mx-auto bg-white rounded-2xl shadow p-6 space-y-5">
        @csrf
        @if($product->exists)
            @method('PUT')
        @endif
        <h2 class="text-xl font-bold mb-4">
            {{ $product->exists ? 'Редактирование товара' : 'Создание товара' }}
        </h2>
        @if ($product->exists)
            <p class="text-sm text-gray-500 mb-2">#{{ $product->id }}</p>
        @endif
        <div>
            <label class="block text-sm font-medium text-gray-700">Название</label>
            <input type="text" name="name" value="{{ old('name', $product->name) }}"
                   class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 text-sm" required>
            @error('name')
            <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700">Цена</label>
            <input type="text" name="price" value="{{ old('price', $product->price) }}"
                   class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 text-sm" required>
            @error('price')
            <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700">Категория</label>
            <select name="category_id"
                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 text-sm" required>
                <option value="">Выберите категорию</option>
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}"
                        {{ old('category_id', $product->category_id) == $category->id ? 'selected' : '' }}>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
            @error('category_id')
            <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700">Описание</label>
            <textarea name="description" rows="5"
                      class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 text-sm">{{ old('description', $product->description) }}</textarea>
            @error('category_id')
            <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
            @enderror
        </div>

        @if ($product->exists)
            <p class="text-xs text-gray-500 mt-4">
                Создан: {{ $product->created_at?->format('d.m.Y H:i') }} |
                Обновлён: {{ $product->updated_at?->format('d.m.Y H:i') }}
            </p>
        @endif

        <div class="mt-6 flex justify-between items-center">
            <a href="{{ route('catalog.index') }}" class="text-sm text-indigo-600 hover:underline">Вернуться в каталог</a>
            <button type="submit" class="bg-indigo-600 text-white px-4 py-2 rounded hover:bg-indigo-700">
                {{ $product->exists ? 'Сохранить изменения' : 'Создать товар' }}
            </button>
        </div>
    </form>
@endsection
