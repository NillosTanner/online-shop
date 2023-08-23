<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class CategoryFactory extends Factory
{
    public function definition(): array
    {
        $categories = collect([
            'Компьютеры',
            'Ноутбуки',
            'Планшеты',
            'Мониторы',
            'Телевизоры',
            'Смартфоны',
            'Фотоаппараты',
            'Аксессуары',
            'Комплектующие',
        ]);

        return [
            'name' => $categories->random(),
        ];
    }
}
