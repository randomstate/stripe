<?php


namespace RandomState\Tests\Stripe\Feature\Fake;


use RandomState\Stripe\Fake\Customers;
use RandomState\Stripe\Fake\Sources;
use RandomState\Tests\Stripe\Feature\Contracts\SourcesContractTest;
use RandomState\Tests\Stripe\TestCase;

class SourcesTest extends TestCase
{
    use SourcesContractTest;

    public function createClient()
    {
        return $this->fake->sources();
    }

    public function createCustomersClient()
    {
        return $this->fake->customers();
    }


}