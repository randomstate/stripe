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
        return $this->fake->customers();
    }

    public function couponsClient()
    {
        return $this->fake->coupons();
    }

    public function subscriptionsClient()
    {
        return $this->fake->subscriptions();
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