<?php


namespace RandomState\Tests\Stripe\Feature\Stripe;


use RandomState\Stripe\Stripe\Customers;
use RandomState\Stripe\Stripe\Sources;
use RandomState\Tests\Stripe\Feature\Contracts\SourcesContractTest;
use RandomState\Tests\Stripe\TestCase;

class SourcesTest extends TestCase
{
    use SourcesContractTest;

    public function createClient()
    {
        return new Sources(env("STRIPE_KEY"));
    }

    public function createCustomersClient()
    {
        return new Customers(env("STRIPE_KEY"));
    }
}