<?php


namespace RandomState\Tests\Stripe\Feature\Fake;


use RandomState\Stripe\Fake\Customers;
use RandomState\Stripe\Fake\Plans;
use RandomState\Stripe\Fake\Products;
use RandomState\Stripe\Fake\SubscriptionItems;
use RandomState\Stripe\Fake\Subscriptions;
use RandomState\Tests\Stripe\Feature\Contracts\SubscriptionItemsContractTests;
use RandomState\Tests\Stripe\Feature\Contracts\SubscriptionsContractTests;
use RandomState\Tests\Stripe\TestCase;

class SubscriptionItemsTest extends TestCase
{
    use SubscriptionItemsContractTests;

    public function createClient()
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

    public function subscriptionsClient()
    {
        return $this->fake->subscriptions();
    }
}