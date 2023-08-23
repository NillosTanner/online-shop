<?php

namespace App\Http\Controllers;

use App\Models\Shop;
use Inertia\Inertia;
use Inertia\Response;

class ShopController extends Controller
{
    public function show(Shop $shop): Response
    {
        return Inertia::render('Shop', [
            'shop' => $shop->load('categories.products'),
        ]);
    }
}
