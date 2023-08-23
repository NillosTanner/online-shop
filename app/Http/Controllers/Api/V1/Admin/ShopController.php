<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreShopRequest;
use App\Http\Requests\Admin\UpdateShopRequest;
use App\Http\Resources\Api\V1\Admin\ShopCollection;
use App\Http\Resources\Api\V1\Admin\ShopResource;
use App\Models\Shop;
use App\Services\ShopService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class ShopController extends Controller
{
    public function __construct(public ShopService $shopService)
    {
    }

    public function index(): ShopCollection
    {
        $this->authorize('shop.viewAny');

        $shops = Shop::with(['city', 'owner'])->get();

        return new ShopCollection($shops);
    }

    public function store(StoreShopRequest $request): ShopResource
    {
        $shop = $this->shopService->createShop(
            $request->validated()
        );

        return new ShopResource($shop);
    }

    public function show(Shop $shop): ShopResource
    {
        $this->authorize('shop.view');

        $shop->load(['city', 'owner']);

        return new ShopResource($shop);
    }

    public function update(UpdateShopRequest $request, Shop $shop): JsonResponse
    {
        $shop = $this->shopService->updateShop(
            $shop,
            $request->validated()
        );

        return (new ShopResource($shop))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }
}
