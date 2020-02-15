<?php


namespace RandomState\Tests\Stripe\Feature\Contracts;


use RandomState\Stripe\Contracts\Charges;
use Stripe\Refund;

trait RefundsContractTests
{
    use ClientTest;

    /**
     * @var Charges
     */
    protected $charges;

    abstract public function createChargesClient();

    public function charges()
    {
        if(!$this->charges){
            $this->charges = $this->createChargesClient();
        }

        return $this->charges;
    }

    /**
     * @test
     */
    public function can_create_a_refund()
    {
        $charge = $this->charges()->create([
            'amount' => 100,
            'currency' => 'gbp',
            'source' => 'tok_visa_debit',
        ]);

        $refund = $this->client()->create([
            'charge' => $charge->id,
            'amount' => 50,
        ]);

        $this->assertInstanceOf(Refund::class, $refund);
        $this->assertEquals(50, $refund->amount);
        $this->assertEquals($charge->id, $refund->charge);
    }

    /**
     * @test
     */
    public function can_retrieve_a_refund()
    {
        $charge = $this->charges()->create([
            'amount' => 100,
            'currency' => 'gbp',
            'source' => 'tok_visa_debit',
        ]);

        $refund = $this->client()->create([
            'charge' => $charge->id,
            'amount' => 50,
        ]);

        $found = $this->client()->retrieve($refund->id);

        $this->assertInstanceOf(Refund::class, $found);
        $this->assertEquals(50, $found->amount);
        $this->assertEquals($charge->id, $refund->charge);
    }

    /**
     * @test
     */
    public function can_update_a_refund()
    {
        $charge = $this->charges()->create([
            'amount' => 100,
            'currency' => 'gbp',
            'source' => 'tok_visa_debit',
        ]);

        $refund = $this->client()->create([
            'charge' => $charge->id,
            'amount' => 50,
        ]);

        $updated = $this->client()->update($refund->id, [
            'metadata' => $metadata = [
                'source' => 'automated_test',
            ]
        ]);

        $this->assertInstanceOf(Refund::class, $updated);
        $this->assertEquals($metadata, $updated->metadata->toArray());
        $this->assertEquals($refund->id, $updated->id);
    }

    /**
     * @test
     */
    public function can_list_all_refunds()
    {
        $charge = $this->charges()->create([
            'amount' => 100,
            'currency' => 'gbp',
            'source' => 'tok_visa_debit',
        ]);

        $refund = $this->client()->create([
            'charge' => $charge->id,
            'amount' => 50,
        ]);

        $refunds = $this->client()->all();

        $this->assertEquals($refund->id, $refunds->data[0]->id);
    }
}