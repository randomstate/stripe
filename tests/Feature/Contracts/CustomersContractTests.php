<?php


namespace RandomState\Tests\Stripe\Feature\Contracts;


use Stripe\Customer;

trait CustomersContractTests
{
    use ClientContracts;

    /**
     * @test
     */
    public function can_create_a_customer()
    {
        $customer = $this->client()->create();

        $this->assertInstanceOf(Customer::class, $customer);
    }

    /**
     * @test
     */
    public function can_retrieve_a_customer()
    {
        $customer = $this->client()->create();

        $found = $this->client->retrieve($customer->id);

        $this->assertInstanceOf(Customer::class, $found);
        $this->assertEquals($customer->id, $found->id);
    }

    /**
     * @test
     */
    public function can_update_a_customer()
    {
        $customer = $this->client()->create();

        $updated = $this->client()->update($customer->id, [
            'description' => 'hello'
        ]);

        $this->assertEquals($customer->id, $updated->id);
        $this->assertEquals('hello', $updated->description);
    }

    /**
     * @test
     */
    public function can_delete_a_customer()
    {
        $customer = $this->client()->create();

        $deleted = $this->client()->delete($customer->id);

        $this->assertEquals($customer->id, $deleted->id);
        $this->assertTrue($deleted->deleted);
    }

    /**
     * @test
     */
    public function can_list_all_customers()
    {
        $customer = $this->client()->create();

        $customers = $this->client()->all();

        $this->assertEquals($customer->id, $customers->data[0]->id);
    }
}