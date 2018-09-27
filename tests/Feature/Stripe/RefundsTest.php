<?php


namespace RandomState\Tests\Stripe\Feature\Stripe;


use RandomState\Stripe\Stripe\Charges;
use RandomState\Stripe\Stripe\Refunds;
use RandomState\Tests\Stripe\Feature\Contracts\RefundsContractTests;
use RandomState\Tests\Stripe\TestCase;

class RefundsTest extends TestCase
{
    use RefundsContractTests;

    public function createClient()
    {
        return new Refunds(env("STRIPE_KEY"));
    }

    public function createChargesClient()
    {
        return new Charges(env("STRIPE_KEY"));
    }
}