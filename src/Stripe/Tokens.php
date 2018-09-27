<?php


namespace RandomState\Stripe\Stripe;


use RandomState\Stripe\Stripe\Traits\Creatable;
use RandomState\Stripe\Stripe\Traits\Retrievable;
use Stripe\Token;

class Tokens extends StripeResourceClient
{
    use Creatable, Retrievable;

    public function getResourceClass()
    {
        return Token::class;
    }
}