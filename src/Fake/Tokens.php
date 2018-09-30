<?php


namespace RandomState\Stripe\Fake;


use RandomState\Stripe\Fake\Traits\Creatable;
use RandomState\Stripe\Fake\Traits\Retrievable;

class Tokens implements \RandomState\Stripe\Contracts\Tokens
{
    use Creatable, Retrievable;

    public function __construct()
    {
        foreach(DummySourceFactory::$cardNumbers as $token) {
            $this->create(['id' => $token]);
        }
    }

    public static function idPrefix()
    {
        return 'tok_';
    }

    public function getResourceClass()
    {
        return Token::class;
    }


}