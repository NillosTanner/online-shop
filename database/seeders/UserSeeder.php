<?php

namespace Database\Seeders;

use App\Enums\RoleName;
use App\Models\City;
use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->createAdminUser();
        $this->createVendorUser();
        $this->createCustomerUser();
    }

    public function createAdminUser()
    {
        User::create([
            'name'     => 'Пользователь Администратор',
            'email'    => 'admin@mail.ru',
            'password' => bcrypt('0000'),
        ])->roles()->sync(Role::where('name', RoleName::ADMIN->value)->first());
    }

    public function createVendorUser()
    {
        $vendor = User::create([
            'name'     => 'Владелец магазина',
            'email'    => 'vendor@mail.ru',
            'password' => bcrypt('0000'),
        ]);

        $vendor->roles()->sync(Role::where('name', RoleName::VENDOR->value)->first());

        $vendor->shop()->create([
            'city_id' => City::where('id', 1)->value('id'),
            'name'    => 'Магазин №1',
            'address' => 'Адрес магазина №1',
        ]);
    }

    public function createCustomerUser()
    {
        $vendor = User::create([
            'name'     => 'Постоянный клиент',
            'email'    => 'customer@mail.ru',
            'password' => bcrypt('0000'),
        ]);

        $vendor->roles()->sync(Role::where('name', RoleName::CUSTOMER->value)->first());
    }
}
