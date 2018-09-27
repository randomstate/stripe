<?php


namespace RandomState\Stripe\Stripe;


use RandomState\Stripe\Stripe\Traits\Creatable;
use Stripe\Token;

class Tokens extends StripeResourceClient
{
    use Creatable;

    public function getResourceClass()
    {
        return Token::class;
    }
}