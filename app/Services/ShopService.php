<?php

namespace App\Services;

use App\Enums\RoleName;
use App\Models\Shop;
use App\Models\Role;
use App\Models\User;
use App\Notifications\ShopOwnerInvitation;
use Illuminate\Support\Facades\DB;

class ShopService
{
    public function createShop(array $attributes): Shop
    {
        $shop = DB::transaction(function () use ($attributes) {
            $user = User::create([
                'name'     => $attributes['owner_name'],
                'email'    => $attributes['email'],
                'password' => '',
            ]);

            $user->roles()->sync(Role::where('name', RoleName::VENDOR->value)->first());

            return $user->shop()->create([
                'city_id' => $attributes['city_id'],
                'name'    => $attributes['shop_name'],
                'address' => $attributes['address'],
            ]);

            $user->notify(new ShopOwnerInvitation($attributes['shop_name']));
        });

        return $shop;
    }

    public function updateShop(Shop $shop, array $attributes): Shop
    {
        $shop->update([
            'city_id' => $attributes['city_id'],
            'name'    => $attributes['shop_name'],
            'address' => $attributes['address'],
        ]);

        return $shop;
    }
}
