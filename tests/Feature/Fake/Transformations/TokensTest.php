<?php


namespace RandomState\Tests\Stripe\Feature\Fake\Transformations;


use RandomState\Stripe\Fake\Token;
use RandomState\Tests\Stripe\TestCase;

class TokensTest extends TestCase
{
    /**
     * @test
     */
    public function tokens_respect_used_status()
    {
        $token = Token::constructFrom([]);
        $this->assertFalse($token->used);
    }
}