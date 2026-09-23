<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('products')->insert([
            [
                'category_id' => 1,
                'name' => 'Smartphone Galaxy',
                'price' => 2500.00,
                'stock' => 15,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'category_id' => 1,
                'name' => 'Notebook Pro',
                'price' => 4800.00,
                'stock' => 8,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'category_id' => 2,
                'name' => 'Mouse Gamer RGB',
                'price' => 180.00,
                'stock' => 40,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'category_id' => 2,
                'name' => 'Teclado Mecânico',
                'price' => 350.00,
                'stock' => 25,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'category_id' => 3,
                'name' => 'Placa de Vídeo RTX 4060',
                'price' => 2300.00,
                'stock' => 5,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'category_id' => 3,
                'name' => 'Processador Intel i7',
                'price' => 1900.00,
                'stock' => 10,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}