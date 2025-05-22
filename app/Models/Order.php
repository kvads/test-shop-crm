<?php

namespace App\Models;

use app\Models\Catalog\Product;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Order extends Model
{
    const STATUSES = [
        'new' => 'Новый',
        'complete' => 'Выполнен'
    ];

    const COMPLETE_STATUS = 'complete';
    const NEW_STATUS = 'new';

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

    /**
     * Аксессор для получения цены заказа
     * @return float
     */
    public function getTotalPriceAttribute(): float
    {
        return $this->quantity * ($this->product?->price ?? 0);
    }

}
