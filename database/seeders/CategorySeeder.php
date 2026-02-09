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
            ['nome' => 'Alimentação fora', 'icon' => 'bi-cart3', 'color' => 'text-warning'],
            ['nome' => 'Banco', 'icon' => 'bi-bank', 'color' => 'text-primary-custom'],
            ['nome' => 'Beleza', 'icon' => 'bi-magic', 'color' => 'text-warning'],
            ['nome' => 'Investimento', 'icon' => 'bi-bank', 'color' => 'text-primary-custom'],
            ['nome' => 'Lazer', 'icon' => 'bi-emoji-laughing', 'color' => 'text-warning'],
            ['nome' => 'Moradia', 'icon' => 'bi-house-door-fill', 'color' => 'text-warning'],
            ['nome' => 'Outros', 'icon' => 'bi-three-dots', 'color' => 'text-warning'],
            ['nome' => 'Salário', 'icon' => 'bi-briefcase', 'color' => 'text-primary-custom'],
            ['nome' => 'Saúde', 'icon' => 'bi-heart-pulse-fill', 'color' => 'text-warning'],
            ['nome' => 'Supermercado', 'icon' => 'bi-cart-check', 'color' => 'text-warning'],
            ['nome' => 'Transferência', 'icon' => 'bi-arrow-left-right', 'color' => 'text-primary-custom'],
            ['nome' => 'Transporte', 'icon' => 'bi-car-front-fill', 'color' => 'text-warning'],
            ['nome' => 'Vestuário', 'icon' => 'bi-handbag', 'color' => 'text-warning'],
        ];

        foreach ($categories as $category) {
            Category::updateOrCreate(['nome' => $category['nome']], $category);
        }
    }
}
