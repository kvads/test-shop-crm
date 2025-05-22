<?php
declare(strict_types=1);

namespace App\Http\Controllers;

use App\Exceptions\Catalog\ProductHasOrdersException;
use App\Http\Requests\ProductRequest;
use App\Models\Catalog\Category;
use App\Models\Catalog\Product;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class CatalogController extends Controller
{
    /**
     * Таблица товаров
     *
     * @return View
     */
    public function index(): View
    {
        try {
            $products = Product::with('category')->select(['id', 'category_id', 'name', 'price'])->get();
            return view('catalog', ['products' => $products]);
        } catch (\Throwable $e) {
            return view('errors.error', ['exception' => $e]);
        }
    }

    /**
     * Карточка создания товара
     *
     * @return View
     */
    public function create(): View
    {
        try {
            $categories = Category::select(['id', 'name'])->get();
            return view('card', ['product' => new Product(), 'categories' => $categories]);
        } catch (\Throwable $e) {
            return view('errors.error', ['exception' => $e]);
        }
    }

    /**
     * Создание товара
     *
     * @param ProductRequest $request
     * @return View|RedirectResponse
     */
    public function store(ProductRequest $request): View|RedirectResponse
    {
        try {
            return response()->redirectToRoute(
                'catalog.show',
                Product::create($request->validated())
            );
        } catch (\Throwable $e) {
            return view('errors.error', ['exception' => $e]);
        }
    }

    /**
     * @param ProductRequest $request
     * @param Product $product
     * @return View|RedirectResponse
     */
    public function update(ProductRequest $request, Product $product): View|RedirectResponse
    {
        try {
            $product->update($request->validated());
            return response()->redirectToRoute('catalog.show', $product);
        } catch (\Throwable $e) {
            return view('errors.error', ['exception' => $e]);
        }
    }

    /**
     * Удаление товара
     *
     * @param Product $product
     * @return View|RedirectResponse
     */
    public function destroy(Product $product): View|RedirectResponse
    {
        try {
            if ($product->has('orders')) {
                throw new ProductHasOrdersException();
            }
            $product->delete();
            return response()->redirectToRoute('catalog.index');
        } catch (\Throwable $e) {
            return view('errors.error', ['exception' => $e]);
        }
    }

    /**
     * Карточка товара
     *
     * @param Product $product
     * @return View
     */
    public function show(Product $product): View
    {
        try {
            $categories = Category::select(['id', 'name'])->get();
            return view('card', ['product' => $product, 'categories' => $categories]);
        } catch (\Throwable $e) {
            return view('errors.error', ['exception' => $e]);
        }
    }
}
