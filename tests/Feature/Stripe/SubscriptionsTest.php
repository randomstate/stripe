<?php


namespace RandomState\Tests\Stripe\Feature\Stripe;


use RandomState\Stripe\Stripe\Customers;
use RandomState\Stripe\Stripe\Plans;
use RandomState\Stripe\Stripe\Products;
use RandomState\Stripe\Stripe\Subscriptions;
use RandomState\Tests\Stripe\Feature\Contracts\SubscriptionsContractTests;
use RandomState\Tests\Stripe\TestCase;


/**
 * Class SubscriptionsTest
 * @package RandomState\Tests\Stripe\Feature\Stripe
 *
 * @group integration
 */
class SubscriptionsTest extends TestCase
{
    use SubscriptionsContractTests;

    public function createClient()
    {
        return new Subscriptions(env("STRIPE_KEY"));
    }

    public function customersClient()
    {
        return new Customers(env("STRIPE_KEY"));
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