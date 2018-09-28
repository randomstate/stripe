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
        return new Refunds;
    }

    public function createChargesClient()
    {
        return new Charges;
    }


}