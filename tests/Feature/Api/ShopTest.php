<?php

namespace Tests\Feature\Api;

use App\Models\City;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Tests\Traits\WithTestingSeeder;

class shopTest extends TestCase
{
    use RefreshDatabase;
    use WithTestingSeeder;

    public function test_admin_can_view_shops(): void
    {
        $admin = User::factory()->admin()->create();

        $response = $this
            ->actingAs($admin)
            ->getJson(route('api.admin.shops.index'));

        $response->assertOk();
    }

    public function test_admin_can_view_shop(): void
    {
        $admin  = User::factory()->admin()->create();
        $vendor = $this->getVendorUser();

        $response = $this
            ->actingAs($admin)
            ->getJson(route('api.admin.shops.show', $vendor->shop));

        $response->assertOk();
    }

    public function test_admin_can_update_shop()
    {
        $admin  = User::factory()->admin()->create();
        $vendor = $this->getVendorUser();

        $response = $this
            ->actingAs($admin)
            ->putJson(route('api.admin.shops.update', $vendor->shop), [
                'shop_name' => 'Updated shop Name',
                'city_id'         => City::where('name', 'Other')->first()->id,
                'address'         => 'Updated Address',
            ]);

        $response->assertAccepted();
    }
}
