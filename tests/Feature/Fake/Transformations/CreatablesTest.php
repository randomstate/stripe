<?php


namespace RandomState\Tests\Stripe\Feature\Fake\Transformations;


use RandomState\Stripe\Fake\Customers;
use RandomState\Tests\Stripe\TestCase;

class CreatablesTest extends TestCase
{
    /**
     * @test
     */
    public function created_at_timestamp_is_added_to_mocks()
    {
        $customer = $this->fake->customers()->create();
        $this->assertEquals(time(), $customer->created);
    }
    
    /**
     * @test
     */
    public function livemode_set_to_true() 
    {
        $customer = $this->fake->customers()->create();
        $this->assertFalse($customer->livemode);
    }
}