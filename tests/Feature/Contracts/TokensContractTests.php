<?php


namespace RandomState\Tests\Stripe\Feature\Contracts;


use Stripe\Token;

trait TokensContractTests
{
    use ClientTest;

    /**
     * @test
     */
    public function can_create_a_token()
    {
        $token = $this->client()->create([
            "card" => [
                "number" => "4242424242424242",
                "exp_month" => 9,
                "exp_year" => (new \DateTime('+1 year'))->format('Y'),
                "cvc" => "314",
            ]
        ]);

        $this->assertInstanceOf(Token::class, $token);
        $this->assertEquals("4242", $token->card->last4);
    }

    /**
     * @test
     */
    public function can_retrieve_a_token()
    {
        $token = $this->client()->create([
            "card" => [
                "number" => "4242424242424242",
                "exp_month" => 9,
                "exp_year" => (new \DateTime('+1 year'))->format('Y'),
                "cvc" => "314",
            ]
        ]);

        $found = $this->client()->retrieve($token->id);

        $this->assertEquals($token->id, $found->id);
    }
}