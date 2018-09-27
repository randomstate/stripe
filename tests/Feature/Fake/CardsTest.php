<?php


namespace RandomState\Tests\Stripe\Feature\Fake;


use RandomState\Stripe\Fake\Customers;
use RandomState\Tests\Stripe\Feature\Contracts\CardsContractTests;
use RandomState\Tests\Stripe\TestCase;

class CardsTest extends TestCase
{
    use CardsContractTests;

    public function customerClient()
    {
        return new Customers;
    }
}