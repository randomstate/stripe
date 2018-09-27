<?php


namespace RandomState\Stripe\Stripe;


use RandomState\Stripe\Stripe\Traits\Creatable;
use RandomState\Stripe\Stripe\Traits\Retrievable;
use Stripe\Token;

class Tokens extends StripeResourceClient implements \RandomState\Stripe\Contracts\Tokens
{
    use Creatable, Retrievable;

    public function getResourceClass()
    {
        return Token::class;
    }
}