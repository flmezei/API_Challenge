<?php

namespace Database\Seeders;

use App\Entities\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        array_map(function ($item) {
            Product::create([
                'name' => $item,
                'price' => fake()->randomFloat(2, 7, 20),
                'photo' => fake()->imageUrl(200, 200),
            ]);
        }, [
            'Carne',
            'Frango',
            'Queijo',
            'Bacalhau',
            'Carne com queijo',
            'Frango com catupiry',
            'Carne seca',
            'Bauru',
            'Especial de queijo',
            'Especial de carne',
        ]);

        $this->command->info('Produtos criados com sucesso!');
    }
}
