<?php


namespace RandomState\Tests\Stripe\Feature\Stripe;


use RandomState\Stripe\Stripe\Tokens;
use RandomState\Tests\Stripe\Feature\Contracts\TokensContractTests;
use RandomState\Tests\Stripe\TestCase;

/**
 * Class TokensTest
 * @package RandomState\Tests\Stripe\Feature\Stripe
 *
 * @group integration
 */
class TokensTest extends TestCase
{
    use TokensContractTests;

    public function createClient()
    {
        return new Tokens(env("STRIPE_KEY"));
    }
}