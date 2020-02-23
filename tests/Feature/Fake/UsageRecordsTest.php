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
        return $this->fake->usageRecords();
    }

    public function subscriptionsClient()
    {
        return $this->fake->subscriptions();
    }

    public function subscriptionItemsClient()
    {
        return $this->fake->subscriptions()->items();
    }

    public function customersClient()
    {
        return $this->fake->customers();
    }

    public function plansClient()
    {
        return $this->fake->plans();
    }

    public function productsClient()
    {
        return $this->fake->products();
    }


}