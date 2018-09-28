<?php


namespace RandomState\Tests\Stripe\Feature\Fake;


use RandomState\Stripe\Fake\Tokens;
use RandomState\Tests\Stripe\Feature\Contracts\TokensContractTests;
use RandomState\Tests\Stripe\TestCase;

class TokensTest extends TestCase
{
    use TokensContractTests;

    public function createClient()
    {
        return new Tokens;
    }


}