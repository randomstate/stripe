<?php


namespace RandomState\Tests\Stripe\Feature\Stripe;


use RandomState\Stripe\Stripe\Charges;
use RandomState\Stripe\Stripe\Refunds;
use RandomState\Tests\Stripe\Feature\Contracts\RefundsContractTests;
use RandomState\Tests\Stripe\TestCase;


/**
 * Class RefundsTest
 * @package RandomState\Tests\Stripe\Feature\Stripe
 *
 * @group integration
 */
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