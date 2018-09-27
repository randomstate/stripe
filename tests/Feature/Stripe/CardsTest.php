<?php


namespace RandomState\Tests\Stripe\Feature\Stripe;


use RandomState\Stripe\Stripe\Customers;
use RandomState\Tests\Stripe\Feature\Contracts\CardsContractTests;
use RandomState\Tests\Stripe\TestCase;

class CardsTest extends TestCase
{
    use CardsContractTests;

    public function customerClient()
    {
        return new Customers(env("STRIPE_KEY"));
    }
}