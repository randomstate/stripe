<?php


namespace RandomState\Tests\Stripe\Feature\Fake;


use RandomState\Stripe\Fake\Customers;
use RandomState\Stripe\Fake\Plans;
use RandomState\Stripe\Fake\Products;
use RandomState\Stripe\Fake\SubscriptionItems;
use RandomState\Stripe\Fake\Subscriptions;
use RandomState\Stripe\Fake\UsageRecords;
use RandomState\Tests\Stripe\Feature\Contracts\ClientTest;
use RandomState\Tests\Stripe\Feature\Contracts\UsageRecordsContractTests;
use RandomState\Tests\Stripe\TestCase;

class UsageRecordsTest extends TestCase
{
    use ClientTest, UsageRecordsContractTests;

    public function createClient()
    {
        return new UsageRecords;
    }

    public function subscriptionsClient()
    {
        return new Subscriptions;
    }

    public function subscriptionItemsClient()
    {
        return new SubscriptionItems;
    }

    public function customersClient()
    {
        return new Customers;
    }

    public function plansClient()
    {
        return new Plans;
    }

    public function productsClient()
    {
        return new Products;
    }


}