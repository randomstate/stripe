<?php


namespace RandomState\Tests\Stripe\Feature\Contracts;


trait ChargesContractTests
{
    use ClientTest;

    /**
     * @test
     */
    public function can_create_a_charge()
    {
        $charge = $this->client()->create([
            'amount' => 100,
            'currency' => 'gbp',
            'source' => 'tok_visa_debit',
        ]);

        $this->assertEquals(100, $charge->amount);
        $this->assertEquals('gbp', $charge->currency);
    }

    /**
     * @test
     */
    public function can_retrieve_a_charge()
    {
        $charge = $this->client()->create([
            'amount' => 100,
            'currency' => 'gbp',
            'source' => 'tok_visa_debit',
        ]);

        $found = $this->client()->retrieve($charge->id);
        $this->assertEquals($charge->id, $found->id);
        $this->assertEquals($charge->amount, $found->amount);
    }

    /**
     * @test
     */
    public function can_update_a_charge()
    {
        $charge = $this->client()->create([
            'amount' => 100,
            'description' => 'hello world',
            'currency' => 'gbp',
            'source' => 'tok_visa_debit',
        ]);

        $originalDescription = $charge->description;

        $charge = $this->client()->update($charge->id, [
            'description' => 'new world',
        ]);

        $this->assertEquals('hello world', $originalDescription);
        $this->assertEquals('new world', $charge->description);
    }

    /**
     * @test
     */
    public function can_capture_a_charge()
    {
        $charge = $this->client()->create([
            'amount' => 100,
            'capture' => false,
            'currency' => 'gbp',
            'source' => 'tok_visa_debit',
        ]);

        $charge->capture();

        $this->assertTrue($charge->captured);
    }

    /**
     * @test
     */
    public function can_list_charges()
    {
        $charge = $this->client()->create([
            'amount' => 100,
            'currency' => 'gbp',
            'source' => 'tok_visa_debit',
        ]);

        $charges = $this->client()->all();

        $this->assertEquals($charge->id, $charges->data[0]->id);
    }
}