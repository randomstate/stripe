<?php


namespace RandomState\Tests\Stripe\Feature;


use RandomState\Stripe\BillingProvider;
use RandomState\Stripe\Stripe;
use RandomState\Tests\Stripe\TestCase;

class StripeTest extends TestCase
{
    use BillingProviderContractTests;

    public function getProvider(): BillingProvider
    {
        return new Stripe(env("STRIPE_KEY"));
    }

}