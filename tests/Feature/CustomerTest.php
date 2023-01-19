<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Entities\Customer;

class CustomerTest extends TestCase
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
     * A basic feature test example.
     *
     * @return void
     */
    public function test_create_customer()
    {
        Customer::create([
            'name' => fake()->name(),
            'email' => rand() . '.@gmail.com',
            'phone' => fake()->e164PhoneNumber(),
            'birth' => fake()->date('Y-m-d'),
            'street' => fake()->streetName(),
            'number' => fake()->buildingNumber(),
            'complement' => fake()->secondaryAddress(),
            'neighborhood' => fake()->citySuffix(),
            'zip_code' => fake()->postcode(),
            'registration_date' => fake()->date('Y-m-d'),
        ]);


        $response = $this->get('/');

        $response->assertStatus(200);
    }

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_update_customer()
    {
        $customer = Customer::first();

        $customer->update([
            'name' => fake()->name(),
            'email' => rand() . '.@gmail.com',
            'phone' => fake()->e164PhoneNumber(),
            'birth' => fake()->date('Y-m-d'),
            'street' => fake()->streetName(),
            'number' => fake()->buildingNumber(),
            'complement' => fake()->secondaryAddress(),
            'neighborhood' => fake()->citySuffix(),
            'zip_code' => fake()->postcode(),
            'registration_date' => fake()->date('Y-m-d'),
        ]);

        $response = $this->get('/');
        $response->assertStatus(200);
    }

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_find_customer()
    {
        Customer::first();

        $response = $this->get('/');
        $response->assertStatus(200);
    }

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_delete_customer()
    {
        $customer = Customer::first();

        $customer->delete();

        $response = $this->get('/');
        $response->assertStatus(200);
    }
}
