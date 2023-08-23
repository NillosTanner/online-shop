<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;

class UpdateShopRequest extends FormRequest
{
    public function authorize(): bool
    {
        return Gate::allows('shop.update');
    }

    public function rules(): array
    {
        return [
            'shop_name' => ['required', 'string', 'max:255'],
            'city_id'   => ['required', 'numeric', 'exists:cities,id'],
            'address'   => ['required', 'string', 'max:1000'],
        ];
    }
}
