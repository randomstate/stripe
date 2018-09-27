<?php


namespace RandomState\Tests\Stripe\Feature\Fake;


use RandomState\Stripe\Fake\Coupons;
use RandomState\Stripe\Fake\Customers;
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


}