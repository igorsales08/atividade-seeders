<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        DB::table('categories')->insert([
            [
                'id' => 1,
                'name' => 'Eletrônicos',
                'description' => 'Aparelhos, celulares e gadgets em geral',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 2,
                'name' => 'Periféricos',
                'description' => 'Acessórios para computador e escritório',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 3,
                'name' => 'Hardware',
                'description' => 'Componentes e peças para PC',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}