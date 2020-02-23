<?php


namespace RandomState\Tests\Stripe\Feature\Fake;


use RandomState\Stripe\Fake\Customers;
use RandomState\Stripe\Fake\Plans;
use RandomState\Stripe\Fake\Products;
use RandomState\Stripe\Fake\Subscriptions;
use RandomState\Tests\Stripe\Feature\Contracts\SubscriptionsContractTests;
use RandomState\Tests\Stripe\TestCase;

class SubscriptionsTest extends TestCase
{
    use SubscriptionsContractTests;

    public function createClient()
    {
        return $this->fake->subscriptions();
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