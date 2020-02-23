<?php


namespace RandomState\Tests\Stripe\Feature\Fake;


use RandomState\Stripe\Fake\Charges;
use RandomState\Stripe\Fake\Refunds;
use RandomState\Tests\Stripe\Feature\Contracts\RefundsContractTests;
use RandomState\Tests\Stripe\TestCase;

class RefundsTest extends TestCase
{
    use RefundsContractTests;

    public function createClient()
    {
        return $this->fake->refunds();
    }

    public function createChargesClient()
    {
        return $this->fake->charges();
    }


}