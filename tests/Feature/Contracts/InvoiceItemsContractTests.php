<?php


namespace RandomState\Tests\Stripe\Feature\Contracts;



trait InvoiceItemsContractTests
{
    protected $client;
    protected $customersClient;

    protected function setUp()
    {
        parent::setUp();
        $this->client = $this->createClient();
        $this->customersClient = $this->createCustomersClient();
    }

    abstract public function createClient();
    abstract public function createCustomersClient();

    /**
     * @test
     */
    public function can_create_an_invoice_item()
    {
        $customer = $this->customersClient->create();
        $item = $this->client->create([
            'currency' => 'usd',
            'customer' => $customer->id,
            'amount' => 10000,
            'description' => 'my test invoice item',
        ]);

        $this->assertEquals($customer->id, $item->customer);
        $this->assertEquals('usd', $item->currency);
        $this->assertEquals(10000, $item->amount);
        $this->assertEquals('my test invoice item', $item->description);
    }

    /**
     * @test
     */
    public function can_retrieve_an_invoice_item()
    {
        $customer = $this->customersClient->create();
        $item = $this->client->create([
            'currency' => 'usd',
            'customer' => $customer->id,
            'amount' => 10000
        ]);

        $found = $this->client->retrieve($item->id);

        $this->assertEquals($found->id, $item->id);
        $this->assertEquals($found->currency, $item->currency);
        $this->assertEquals($found->customer, $item->customer);
        $this->assertEquals($found->amount, $item->amount);
    }

    /**
     * @test
     */
    public function can_update_an_invoice_item()
    {
        $customer = $this->customersClient->create();
        $item = $this->client->create([
            'currency' => 'usd',
            'customer' => $customer->id,
            'amount' => 10000
        ]);

        $this->client->update($item->id, [
            'amount' => 5000,
        ]);

        $found = $this->client->retrieve($item->id);

        $this->assertEquals($found->amount, 5000);
    }

    /**
     * @test
     */
    public function can_list_all_invoice_items()
    {
        $customer = $this->customersClient->create();
        $customer2 = $this->customersClient->create();

        $now = time();

        $this->client->create([
            'currency' => 'usd',
            'customer' => $customer->id,
            'amount' => 10000
        ]);

        $this->client->create([
            'currency' => 'gbp',
            'customer' => $customer2->id,
            'amount' => 2000,
        ]);

        $this->assertCount(2, $this->client->all(['created' => ['gte' => $now]])->data);
        $this->assertCount(1, $this->client->all(['customer' => $customer->id]));
    }
}