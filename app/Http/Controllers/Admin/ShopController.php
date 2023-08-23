<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreShopRequest;
use App\Http\Requests\Admin\UpdateShopRequest;
use App\Models\City;
use App\Models\Shop;
use App\Services\ShopService;
use Illuminate\Http\RedirectResponse;
use Inertia\Inertia;
use Inertia\Response;

class ShopController extends Controller
{
    public function __construct(public ShopService $shopService)
    {
    }

    public function index(): Response
    {
        $this->authorize('shop.viewAny');

        return Inertia::render('Admin/Shops/Index', [
            'shops' => Shop::with(['city', 'owner'])->get(),
        ]);
    }

    public function create()
    {
        $this->authorize('shop.create');

        return Inertia::render('Admin/Shops/Create', [
            'cities' => City::get(['id', 'name']),
        ]);
    }

    public function store(StoreShopRequest $request): RedirectResponse
    {
        $this->shopService->createShop(
            $request->validated()
        );

        return to_route('admin.shops.index');
    }

    public function edit(Shop $shop): Response
    {
        $this->authorize('shop.update');

        $shop->load(['city', 'owner']);

        return Inertia::render('Admin/Shops/Edit', [
            'shop' => $shop,
            'cities'     => City::get(['id', 'name']),
        ]);
    }

    public function update(UpdateShopRequest $request, Shop $shop): RedirectResponse
    {
        $this->shopService->updateShop(
            $shop,
            $request->validated()
        );

        return to_route('admin.shops.index')
            ->withStatus('Shop updated successfully.');
    }
}
