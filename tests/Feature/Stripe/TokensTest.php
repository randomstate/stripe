<?php


namespace RandomState\Tests\Stripe\Feature\Stripe;


use RandomState\Stripe\Stripe\Tokens;
use RandomState\Tests\Stripe\Feature\Contracts\TokensContractTests;
use RandomState\Tests\Stripe\TestCase;

class TokensTest extends TestCase
{
    use TokensContractTests;

    public function createClient()
    {
        return new Tokens(env("STRIPE_KEY"));
    }
}