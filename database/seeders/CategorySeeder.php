<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    /**
     * Executa as migrações
     */
    public function run(): void
    {
        $categories = [
            ['nome' => 'Salário', 'icon' => 'bi-briefcase', 'color' => 'text-primary-custom'],
            ['nome' => 'Transporte', 'icon' => 'bi-car-front-fill', 'color' => 'text-warning'],
            ['nome' => 'Lazer', 'icon' => 'bi-emoji-laughing', 'color' => 'text-warning'],
            ['nome' => 'Moradia', 'icon' => 'bi-house-door-fill', 'color' => 'text-warning'],
            ['nome' => 'Transferência', 'icon' => 'bi-arrow-left-right', 'color' => 'text-primary-custom'],
            ['nome' => 'Alimentação', 'icon' => 'bi-cart3', 'color' => 'text-warning'],
            ['nome' => 'Saúde', 'icon' => 'bi-heart-pulse-fill', 'color' => 'text-warning'],
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }
    }
}
