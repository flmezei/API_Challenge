<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Entities\Product;

class ProductTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_product_create()
    {
        array_map(function ($item) {
            Product::create([
                'name' => $item,
                'price' => fake()->randomFloat(2, 7, 20),
                'photo' => fake()->imageUrl(200, 200),
            ]);
        }, [
            'Especial de frango',
            'Especial de bacalhau',
            'Especial de carne seca',
            'Especial de carne com queijo',
            'Especial de frango com catupiry',
            'Especial de carne seca com queijo',
            'Especial de carne com queijo e catupiry',
            'Especial de frango com queijo e catupiry',
            'Especial de bacalhau com queijo e catupiry',
            'Especial de carne seca com queijo e catupiry',
        ]);

        $response = $this->get('/');

        $response->assertStatus(200);
    }

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_product_update()
    {
        $product = Product::first();

        $product->update([
            'name' => 'Especial de frango com queijo e catupiry',
            'price' => fake()->randomFloat(2, 7, 20),
            'photo' => fake()->imageUrl(200, 200),
        ]);

        $response = $this->get('/');

        $response->assertStatus(200);
    }

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_product_find()
    {
        $product = Product::first();

        $response = $this->get('/');

        $response->assertStatus(200);
    }

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_product_delete()
    {
        $product = Product::first();

        $product->delete();

        $response = $this->get('/');

        $response->assertStatus(200);
    }
}
