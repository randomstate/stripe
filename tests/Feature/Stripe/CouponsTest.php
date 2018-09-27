<?php


namespace RandomState\Tests\Stripe\Feature\Stripe;


use RandomState\Stripe\Stripe\Coupons;
use RandomState\Tests\Stripe\Feature\Contracts\CouponsContractTests;
use RandomState\Tests\Stripe\TestCase;

/**
 * Class CouponsTest
 * @package RandomState\Tests\Stripe\Feature\Stripe
 *
 * @group integration
 */
class CouponsTest extends TestCase
{
    use CouponsContractTests;

    public function createClient()
    {
        return new Coupons(env("STRIPE_KEY"));
    }
}