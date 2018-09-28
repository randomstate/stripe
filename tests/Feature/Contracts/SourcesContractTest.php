<?php


namespace RandomState\Tests\Stripe\Feature\Contracts;


use Stripe\Source;

trait SourcesContractTest
{
    use ClientTest;

    protected $customers;

    abstract public function createCustomersClient();

    public function customers() {
        if(!$this->customers) {
            $this->customers = $this->createCustomersClient();
        }

        return $this->customers;
    }

    /**
     * @test
     */
    public function can_create_a_source()
    {
        $source = $this->createCardSource();

        $this->assertInstanceOf(Source::class, $source);
    }

    /**
     * @test
     */
    public function can_retrieve_a_source()
    {
        $source = $this->createCardSource();
        $found = $this->client()->retrieve($source->id);

        $this->assertInstanceOf(Source::class, $found);
        $this->assertEquals($source->id, $found->id);
    }

    /**
     * @test
     */
    public function can_update_a_source()
    {
        $source = $this->createCardSource();
        $source->metadata['order_id'] = '123';

        $source->save();

        $this->assertEquals('123', $source->metadata['order_id']);
    }

    /**
     * @test
     */
    public function can_attach_a_source()
    {
        $source = $this->createCardSource();
        $customer = $this->customers()->create();

        $attached = $customer->sources->create(['source' => $source->id]);

        $this->assertEquals($source->id, $attached->id);
        $this->assertEquals($customer->id, $attached->customer);
    }

    /**
     * @test
     */
    public function can_detach_a_source()
    {
        $source = $this->createCardSource();
        $customer = $this->customers()->create();

        $attached = $customer->sources->create(['source' => $source->id]);
        $detached = $customer->sources->retrieve($attached->id)->detach();

        $this->assertEquals('consumed', $detached->status);
    }


    private function createCardSource()
    {
        return $this->client()->create([
            'type' => 'card',
            'card' => [
                'number' => '4242424242424242',
                'exp_month' => 9,
                'exp_year' => (new \DateTime('+1 year'))->format('Y'),
                'cvc' => '312',
            ]
        ]);
    }
}