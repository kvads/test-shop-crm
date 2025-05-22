<?php

namespace App\Models\Catalog;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Product extends Model
{
    protected $fillable = [
        'name',
        'description',
        'category_id',
        'price',
    ];

    /**
     * Отношение товара к категории
     *
     * @return BelongsTo
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * Отношение товара к заказам
     *
     * @return HasMany
     */
    public function orders(): HasMany
    {
        return $this->hasMany(Product::class);
    }
}
