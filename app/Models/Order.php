<?php

namespace App\Models;

use app\Models\Catalog\Product;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Order extends Model
{
    protected $fillable = [
        'client_full_name',
        'status',
        'comment',
        'product_id',
        'quantity',
    ];

    /**
     * Отношение заказа к товару
     *
     * @return BelongsTo
     */
    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }
}
