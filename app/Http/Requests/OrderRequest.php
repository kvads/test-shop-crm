<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OrderRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'product_id' => 'required|int|exists:products,id',
            'comment' => 'nullable|string|max:65535',
            'client_full_name' => 'required|string|max:255',
            'quantity' => 'required|int',
        ];
    }
}
