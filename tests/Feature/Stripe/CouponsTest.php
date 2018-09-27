<?php


namespace RandomState\Tests\Stripe\Feature\Stripe;


use RandomState\Stripe\Stripe\Coupons;
use RandomState\Tests\Stripe\Feature\Contracts\CouponsContractTests;
use RandomState\Tests\Stripe\TestCase;

class CouponsTest extends TestCase
{
    use CouponsContractTests;

    public function createClient()
    {
        return new Coupons(env("STRIPE_KEY"));
    }
}