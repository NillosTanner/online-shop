<?php

namespace App\Http\Requests\Customer;

use App\Services\CartService;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;

class StoreOrderRequest extends FormRequest
{
    public function authorize(): bool
    {
        return Gate::allows('order.create');
    }

    public function rules(): array
    {
        return [
            'shop_id'         => ['required', 'exists:shops,id'],
            'items'                 => ['required', 'array'],
            'items.*.id'            => ['required', 'exists:products,id'],
            'items.*.name'          => ['required', 'string'],
            'items.*.price'         => ['required', 'integer'],
            'items.*.shop_id' => ['required', 'exists:shops,id', 'in:' . $this->shop_id],
            'total'                 => ['required', 'integer', 'gt:0'],
        ];
    }

    protected function prepareForValidation(): void
    {
        $cart = new CartService();

        $this->merge([
            'shop_id'       => $cart->shopId(),
            'items'         => $cart->items(),
            'total'         => $cart->total(),
        ]);
    }
}
