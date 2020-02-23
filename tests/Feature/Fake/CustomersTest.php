<?php


namespace RandomState\Tests\Stripe\Feature\Fake;


use RandomState\Stripe\Fake\Customers;
use RandomState\Tests\Stripe\Feature\Contracts\CustomersContractTests;
use RandomState\Tests\Stripe\TestCase;

class CustomersTest extends TestCase
{
    use CustomersContractTests;

    public function createClient()
    {
        return $this->fake->customers();
    }
}