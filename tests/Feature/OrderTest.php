<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Entities\Order;
use Illuminate\Support\Facades\Request;

class OrderTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @var Repository
     */
    protected $repository;

    /**
     * @var CustomerRepository
     */
    protected $customerRepository;

    /**
     * @var Request
     */
    public $request;

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_create_order()
    {
        Order::create([
            'customer_id' => rand(1, 10),
            'total_price' => fake()->randomFloat(2, 7, 20),
            'creation_date' => fake()->date('Y-m-d'),
        ]);

        $response = $this->get('/');

        $response->assertStatus(200);
    }

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_show_order()
    {
        $order = Order::first();

        $response = $this->get('/');

        $response->assertStatus(200);
    }

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_find_order()
    {
        $order = Order::first();

        $response = $this->get('/');

        $response->assertStatus(200);
    }

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_delete_order()
    {
        $order = Order::first();

        $order->delete();

        $response = $this->get('/');

        $response->assertStatus(200);
    }
}
