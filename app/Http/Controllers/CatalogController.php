<?php
declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use App\Models\Catalog\Category;
use App\Models\Catalog\Product;
use App\Services\CatalogService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class CatalogController extends Controller
{
    protected CatalogService $service;

    public function __construct(CatalogService $service)
    {
        $this->service = $service;
    }

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
            return view('errors.catalog', ['exception' => $e]);
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
            return view('errors.catalog', ['exception' => $e]);
        }
    }

    public function store(ProductRequest $request): View|RedirectResponse
    {
        try {
            return response()->redirectToRoute(
                'catalog.show',
                Product::create($request->validated())
            );
        } catch (\Throwable $e) {
            return view('errors.catalog', ['exception' => $e]);
        }
    }

    /**
     * @param Request $request
     * @param Product $product
     * @return View|RedirectResponse
     */
    public function update(ProductRequest $request, Product $product): View|RedirectResponse
    {
        try {
            $product->update($request->validated());
            return response()->redirectToRoute('catalog.show', $product);
        } catch (\Throwable $e) {
            return view('errors.catalog', ['exception' => $e]);
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
            $product->delete();
            return response()->redirectToRoute('catalog.index');
        } catch (\Throwable $e) {
            return view('errors.catalog', ['exception' => $e]);
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
            return view('errors.catalog', ['exception' => $e]);
        }
    }
}
