<?php


namespace RandomState\Stripe\Fake;


use RandomState\Stripe\Fake\Traits\Creatable;
use RandomState\Stripe\Fake\Traits\Retrievable;

class Tokens
{
    use Creatable, Retrievable;

    public static function idPrefix()
    {
        return 'tok_';
    }

    public function getResourceClass()
    {
        return Token::class;
    }


}