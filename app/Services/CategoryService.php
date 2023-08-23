<?php

namespace App\Services;

use App\Models\Category;
use App\Models\Shop;
use Illuminate\Support\Collection;

class CategoryService
{
    public function getShopCategories(bool $withProducts = false): Collection
    {
        return Category::when(
            $withProducts,
            fn ($q) => $q->with('products')
        )
            ->where('shop_id', auth()->user()->shop->id)
            ->get();
    }

    public function createCategory(Shop $shop, array $attributes): Category
    {
        return $shop->categories()->create($attributes);
    }

    public function updateCategory(Category $category, array $attributes): Category
    {
        $category->update($attributes);

        return $category;
    }

    public function deleteCategory(Category $category): void
    {
        $category->delete();
    }
}
