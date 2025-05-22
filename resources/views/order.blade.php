@php
    $statusClasses = [
        'new' => 'bg-gray-100 text-gray-800',
        'complete' => 'bg-green-100 text-green-800',
    ];
@endphp

@extends('layouts.app')
@section('title', $order->exists ? 'Заказ #' . $order->id : 'Создание заказа' )
@section('content')
    <div class="max-w-xl mx-auto bg-white rounded-2xl shadow p-6 space-y-5">
        <form method="POST"  action="{{ $order->exists ? route('orders.update', $order) : route('orders.store') }}">
            @csrf
            @if($order->exists)
                @method('PUT')
            @endif
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-2 mb-4">
                <h2 class="text-xl font-bold">
                    {{ $order->exists ? 'Редактирование заказа' : 'Создание заказа' }}
                </h2>

                @if($order->exists)
                    <div class="flex items-center gap-2 text-sm text-gray-600">
                        <p class="text-sm text-gray-500">#{{ $order->id }}</p>
                        <span class="px-2 py-1 text-xs font-semibold rounded-full {{ $statusClasses[$order->status] ?? 'bg-gray-100 text-gray-800' }}">
                        {{ \App\Models\Order::STATUSES[$order->status] }}
                    </span>
                    </div>
                @endif
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700">ФИО</label>
                <input type="text" name="client_full_name" value="{{ old('name', $order->client_full_name) }}"
                       class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 text-sm" required>
                @error('client_full_name')
                <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700">Комментарий</label>
                <textarea name="comment" rows="5"
                          class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 text-sm">{{ old('description', $order->comment) }}</textarea>
                @error('comment')
                <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700">Товар</label>
                <select name="product_id"
                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 text-sm" required>
                    <option value="">Выберите товар</option>
                    @foreach ($products as $product)
                        <option value="{{ $product->id }}"
                            {{ old('product_id', $order->product_id) == $product->id ? 'selected' : '' }}>
                            {{ '#' . $product->id . ' ' . $product->name }}
                        </option>
                    @endforeach
                </select>
                @error('product_id')
                <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700">Количество</label>
                <input type="text" name="quantity" value="{{ old('name', $order->quantity) }}"
                       class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 text-sm" required>
                @error('quantity')
                <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
                @enderror
            </div>

            @if ($order->exists)
                <p class="text-xs text-gray-500 mt-4">
                    Создан: {{ $order->created_at?->format('d.m.Y H:i') }} |
                    Обновлён: {{ $order->updated_at?->format('d.m.Y H:i') }}
                </p>
            @endif

            <div class="mt-6 flex justify-between items-center">
                <a href="{{ route('orders.index') }}" class="text-sm text-indigo-600 hover:underline">Вернуться к списку заказов</a>
                <button type="submit" class="bg-indigo-600 text-white px-4 py-2 rounded hover:bg-indigo-700">
                    {{ $order->exists ? 'Сохранить изменения' : 'Создать заказ' }}
                </button>
            </div>
        </form>
        @if ($order->exists && $order->status !== 'complete')
            <form method="POST" action="{{ route('orders.completed', $order) }}" class="mb-4">
                @csrf
                @method('PUT')
                <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700 text-sm">
                    Отметить как выполненный
                </button>
            </form>
        @endif
    </div>
@endsection
