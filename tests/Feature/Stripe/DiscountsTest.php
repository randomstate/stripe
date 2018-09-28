<?php


namespace RandomState\Tests\Stripe\Feature\Stripe;


use RandomState\Stripe\Stripe\Coupons;
use RandomState\Stripe\Stripe\Customers;
use RandomState\Stripe\Stripe\Plans;
use RandomState\Stripe\Stripe\Products;
use RandomState\Stripe\Stripe\Subscriptions;
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

    public function subscriptionsClient()
    {
        return new Subscriptions(env("STRIPE_KEY"));
    }

    public function plansClient()
    {
        return new Plans(env("STRIPE_KEY"));
    }

    public function productsClient()
    {
        return new Products(env("STRIPE_KEY"));
    }
}