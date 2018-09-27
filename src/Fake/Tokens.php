<?php


namespace RandomState\Stripe\Fake;


use RandomState\Stripe\Fake\Traits\Creatable;

class Tokens
{
    use Creatable;

    public static function idPrefix()
    {
        return 'tok_';
    }

    public function getResourceClass()
    {
        return Token::class;
    }


}