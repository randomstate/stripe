<?php


namespace RandomState\Tests\Stripe\Feature;


use RandomState\Stripe\BillingProvider;
use RandomState\Stripe\Fake;
use RandomState\Tests\Stripe\TestCase;

class FakeTest extends TestCase
{
    use BillingProviderContractTests;

    public function getProvider(): BillingProvider
    {
        return new Fake();
    }


}