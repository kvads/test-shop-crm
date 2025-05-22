@extends('layouts.app')
@section('title', 'Заказы')
@section('content')
    <div class="bg-white p-6 rounded-2xl shadow-md">
        <div class="flex justify-end mb-4">
            <a href="{{ route('orders.create') }}"
               class="inline-block bg-indigo-600 text-white text-sm font-semibold px-4 py-2 rounded hover:bg-indigo-700 transition">Создать заказ
            </a>
        </div>
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200 rounded-lg shadow">
                <thead>
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">#</th>
                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Дата заказа</th>
                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">ФИО</th>
                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Статус</th>
                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Итоговая цена</th>
                </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-100">
                @foreach ($orders as $order)
                    <tr class="hover:bg-gray-50">
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">{{ $order->id }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $order->created_at?->format('d.m.Y H:i') }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $order->client_full_name }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">{{ \App\Models\Order::STATUSES[$order->status] }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">{{ $order->getTotalPriceAttribute() }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-left text-sm font-medium space-x-2 flex gap-2">
                            <a href="{{ route('orders.show', $order) }}"
                               class="px-3 py-1 bg-indigo-600 text-white rounded hover:bg-indigo-700 transition">
                                Редактировать
                            </a>
                            <form action="{{ route('orders.destroy', $order) }}" method="POST">
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
