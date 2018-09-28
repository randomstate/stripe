<?php


namespace RandomState\Tests\Stripe\Feature\Fake;


use RandomState\Stripe\Fake\Coupons;
use RandomState\Stripe\Fake\Customers;
use RandomState\Stripe\Fake\Plans;
use RandomState\Stripe\Fake\Products;
use RandomState\Stripe\Fake\Subscriptions;
use RandomState\Tests\Stripe\Feature\Contracts\DiscountsContractTests;
use RandomState\Tests\Stripe\TestCase;

class DiscountsTest extends TestCase
{
    use DiscountsContractTests;

    public function customersClient()
    {
        return new Customers;
    }

    public function couponsClient()
    {
        return new Coupons;
    }

    public function subscriptionsClient()
    {
        return new Subscriptions;
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