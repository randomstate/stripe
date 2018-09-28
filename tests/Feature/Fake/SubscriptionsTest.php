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
        return new Subscriptions;
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