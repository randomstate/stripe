<?php


namespace RandomState\Tests\Stripe\Feature\Contracts;


use Stripe\Card;

trait CardsContractTests
{
    protected $customers;

    public function setUp()
    {
        parent::setUp();
        $this->customers = $this->customerClient();
    }

    abstract public function customerClient();

    /**
     * @test
     */
    public function can_create_card()
    {
        $customer = $this->customers->create();
        $source = $customer->sources->create(['source' => 'tok_visa']);

        $this->assertInstanceOf(Card::class, $source);
    }

    /**
     * @test
     */
    public function can_retrieve_a_card()
    {
        $customer = $this->customers->create();
        $source = $customer->sources->create(['source' => 'tok_visa']);

        $found = $customer->sources->retrieve($source->id);

        $this->assertInstanceOf(Card::class, $found);
        $this->assertEquals($source->id, $found->id);
    }

    /**
     * @test
     */
    public function can_update_a_card()
    {
        $customer = $this->customers->create();
        $source = $customer->sources->create(['source' => 'tok_visa', 'address_city' => null, 'name' => null]);

        $updated = $customer->sources->retrieve($source->id);
        $updated->address_city = 'London';
        $updated->name = 'John Doe';
        $updated->save();

        $this->assertNull($source->name);
        $this->assertNull($source->address_city);
        $this->assertEquals('London', $updated->address_city);
        $this->assertEquals('John Doe', $updated->name);
    }

    /**
     * @test
     */
    public function can_list_all_cards()
    {
        $customer = $this->customers->create();
        $source = $customer->sources->create(['source' => 'tok_visa']);

        $cards = $customer->sources->all(['object' => 'card']);

        $this->assertEquals($source->id, $cards->data[0]->id);
    }

    /**
     * @test
     */
    public function can_delete_a_card()
    {
        $customer = $this->customers->create();
        $source = $customer->sources->create(['source' => 'tok_visa']);

        $deleted = $customer->sources->retrieve($source->id)->delete();

        $this->assertEquals($source->id, $deleted->id);
        $this->assertTrue($deleted->deleted);
    }

}