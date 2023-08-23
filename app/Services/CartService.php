<?php

namespace App\Services;

use App\Models\Product;

class CartService
{
    public function all(): array
    {
        return session('cart', [
            'items'           => [],
            'total'           => 0,
            'shop_name' => '',
            'shop_id'   => '',
        ]);
    }

    public function items(): array
    {
        return $this->all()['items'];
    }

    public function total(): int
    {
        return (int) $this->all()['total'];
    }

    public function shopId(): int
    {
        return (int) $this->all()['shop_id'];
    }

    public function flush(): void
    {
        session()->forget('cart');
    }

    public function addItem(Product $product): void
    {
        $shop = $product->category->shop;

        $item            = $product->toArray();
        $item['uuid']    = (string) str()->uuid();
        $item['shop_id'] = $shop->id;

        session()->push('cart.items', $item);
        session()->put('cart.shop_name', $shop->name);
        session()->put('cart.shop_id', $shop->id);

        $this->updateTotal();
    }

    public function removeItem(string $uuid = ''): bool
    {
        $items = collect($this->items());

        [$removed, $new] = $items->partition(fn ($item) => $item['uuid'] === $uuid);

        if (! count($removed)) {
            return false;
        }

        session(['cart.items' => $new->values()->toArray()]);

        $this->updateTotal();

        return true;
    }

    protected function updateTotal(): void
    {
        session()->put('cart.total', collect($this->items())->sum('price'));
    }
}
