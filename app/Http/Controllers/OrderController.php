<?php
declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\OrderRequest;
use App\Models\Catalog\Product;
use App\Models\Order;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class OrderController extends Controller
{
    /**
     * Список заказов
     *
     * @return View
     */
    public function index(): View
    {
        try {
            $orders = Order::with('product')->get();
            return view('orders', ['orders' => $orders]);
        } catch (\Throwable $e) {
            return view('errors.error', ['exception' => $e]);
        }
    }

    /**
     * Карточка для создания заказа
     *
     * @return View|RedirectResponse
     */
    public function create(): View|RedirectResponse
    {
        try {
            $products = Product::all();
            return view('order', ['order' => new Order(), 'products' => $products]);
        } catch (\Throwable $e) {
            return view('errors.error', ['exception' => $e]);
        }
    }

    public function store(OrderRequest $request): View|RedirectResponse
    {
        try {
            return response()->redirectToRoute(
                'orders.show',
                Order::create(array_merge(['status' => Order::NEW_STATUS], $request->validated()))
            );
        } catch (\Throwable $e) {
            return view('errors.error', ['exception' => $e]);
        }
    }

    /**
     * Карточка заказа
     *
     * @param Order $order
     * @return View
     */
    public function show(Order $order): View
    {
        try {
            $products = Product::all();
            return view('order', ['order' => $order, 'products' => $products]);
        } catch (\Throwable $e) {
            return view('errors.error', ['exception' => $e]);
        }
    }

    /**
     * Обновление заказа
     *
     * @param OrderRequest $request
     * @param Order $order
     * @return View|RedirectResponse
     */
    public function update(OrderRequest $request, Order $order): View|RedirectResponse
    {
        try {
            $order->update($request->validated());
            return response()->redirectToRoute('orders.show', $order);
        } catch (\Throwable $e) {
            return view('errors.error', ['exception' => $e]);
        }
    }

    /**
     * Отметка статуса заказа как выполненного
     *
     * @param Order $order
     * @return View|RedirectResponse
     */
    public function completed(Order $order): View|RedirectResponse
    {
        try {
             $order->update(['status' => Order::COMPLETE_STATUS]);
             return response()->redirectToRoute('orders.show', $order);
        } catch (\Throwable $e) {
            return view('errors.error', ['exception' => $e]);
        }
    }

    /**
     * Удаление заказа
     *
     * @param Order $order
     * @return View|RedirectResponse
     */
    public function destroy(Order $order): View|RedirectResponse
    {
        try {
            $order->delete();
            return response()->redirectToRoute('orders.index');
        } catch (\Throwable $e) {
            return view('errors.error', ['exception' => $e]);
        }
    }
}
