<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use App\Models\Shop;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            PermissionSeeder::class,
            RoleSeeder::class,
            CitySeeder::class,
            UserSeeder::class,
        ]);

        $this->seedDemoShops();
    }

    public function seedDemoShops()
    {
        $products    = Product::factory(7);
        $categories  = Category::factory(5)->has($products);
        $staffMember = User::factory()->staff();
        $shop        = Shop::factory()->has($categories)->has($staffMember, 'staff');

        User::factory(5)->vendor()->has($shop)->create();
    }
}
