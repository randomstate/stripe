<?php


namespace RandomState\Tests\Stripe\Feature\Stripe;


use RandomState\Stripe\Stripe\Coupons;
use RandomState\Stripe\Stripe\Customers;
use RandomState\Tests\Stripe\Feature\Contracts\DiscountsContractTests;
use RandomState\Tests\Stripe\TestCase;


/**
 * Class DiscountsTest
 * @package RandomState\Tests\Stripe\Feature\Stripe
 *
 * @group integration
 */
class DiscountsTest extends TestCase
{
    use DiscountsContractTests;

    public function customersClient()
    {
        return new Customers(env("STRIPE_KEY"));
    }

    public function couponsClient()
    {
        return new Coupons(env("STRIPE_KEY"));
    }

    /**
     * @test
     */
    public function can_remove_a_discount_applied_to_a_subscription()
    {
        $this->markTestIncomplete("Need to support subscriptions first");
    }
}