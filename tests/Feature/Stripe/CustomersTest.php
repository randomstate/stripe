<?php


namespace RandomState\Tests\Stripe\Feature\Stripe;


use RandomState\Stripe\Stripe\Customers;
use RandomState\Tests\Stripe\Feature\Contracts\CustomersContractTests;
use RandomState\Tests\Stripe\TestCase;

class CustomersTest extends TestCase
{
    use CustomersContractTests;

    public function createClient()
    {
        return new Customers(env("STRIPE_KEY"));
    }
}