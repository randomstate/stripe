<?php


namespace RandomState\Tests\Stripe\Feature\Stripe;


use RandomState\Stripe\Stripe\Customers;
use RandomState\Stripe\Stripe\Plans;
use RandomState\Stripe\Stripe\Products;
use RandomState\Stripe\Stripe\SubscriptionItems;
use RandomState\Stripe\Stripe\Subscriptions;
use RandomState\Stripe\Stripe\UsageRecords;
use RandomState\Tests\Stripe\Feature\Contracts\ClientTest;
use RandomState\Tests\Stripe\Feature\Contracts\UsageRecordsContractTests;
use RandomState\Tests\Stripe\TestCase;

/**
 * Class UsageRecordsTest
 * @package RandomState\Tests\Stripe\Feature\Stripe
 *
 * @group integration
 */
class UsageRecordsTest extends TestCase
{
    use ClientTest, UsageRecordsContractTests;

    public function createClient()
    {
        return new UsageRecords(env("STRIPE_KEY"));
    }

    public function subscriptionsClient()
    {
        return new Subscriptions(env("STRIPE_KEY"));
    }

    public function subscriptionItemsClient()
    {
        return new SubscriptionItems(env("STRIPE_KEY"));
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