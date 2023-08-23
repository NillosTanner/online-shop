<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use App\Models\Shop;
use App\Models\User;
use Illuminate\Database\Seeder;

class TestingSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            PermissionSeeder::class,
            RoleSeeder::class,
            CitySeeder::class,
        ]);

        $this->seedShopAndProduct();
    }

    protected function seedShopAndProduct(): void
    {
        $products    = Product::factory();
        $categories  = Category::factory()->has($products);
        $staffMember = User::factory()->staff();
        $shop        = Shop::factory()->has($categories)->has($staffMember, 'staff');

        User::factory()->vendor()->has($shop)->create();
    }
}
