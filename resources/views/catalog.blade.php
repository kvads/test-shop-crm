@extends('layouts.app')
@section('title', 'Каталог')
@section('content')
    <div class="bg-white p-6 rounded-2xl shadow-md">
        <div class="flex justify-end mb-4">
            <a href="{{ route('catalog.create') }}"
               class="inline-block bg-indigo-600 text-white text-sm font-semibold px-4 py-2 rounded hover:bg-indigo-700 transition">Создать товар
            </a>
        </div>
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200 rounded-lg shadow">
                <thead>
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">#</th>
                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Название</th>
                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Категория</th>
                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Цена</th>
                </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-100">
                @foreach ($products as $product)
                    <tr class="hover:bg-gray-50">
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">{{ $product->id }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $product->name }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $product->category->name }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">{{ $product->price }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-left text-sm font-medium space-x-2 flex gap-2">
                            <a href="{{ route('catalog.show', $product) }}"
                               class="px-3 py-1 bg-indigo-600 text-white rounded hover:bg-indigo-700 transition">
                                Редактировать
                            </a>
                            <form action="{{ route('catalog.destroy', $product) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                        class="px-3 py-1 bg-red-600 text-white rounded hover:bg-red-700 transition">
                                    Удалить
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
