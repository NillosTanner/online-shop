<?php

namespace Database\Factories;

use App\Enums\RoleName;
use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name'              => fake()->name(),
            'email'             => fake()->unique()->safeEmail(),
            'email_verified_at' => now(),
            'password'          => '$2y$10$AzplKHJMSC0tH98mYNpHVeidz21Uu846gXFFlW/lFgk9dZKv/.cfq', // 0000
            'remember_token'    => Str::random(10),
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     */
    public function unverified(): static
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }

    public function admin()
    {
        return $this->afterCreating(function (User $user) {
            $user->roles()->sync(Role::where('name', RoleName::ADMIN->value)->first());
        });
    }

    public function vendor()
    {
        return $this->afterCreating(function (User $user) {
            $user->roles()->sync(Role::where('name', RoleName::VENDOR->value)->first());
        });
    }

    public function customer()
    {
        return $this->afterCreating(function (User $user) {
            $user->roles()->sync(Role::where('name', RoleName::CUSTOMER->value)->first());
        });
    }

    public function staff()
    {
        return $this->afterCreating(function (User $user) {
            $user->roles()->sync(Role::where('name', RoleName::STAFF->value)->first());
        });
    }
}