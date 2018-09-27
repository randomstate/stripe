<?php


namespace RandomState\Stripe\Fake;


use RandomState\Stripe\Fake\Traits\Creatable;
use RandomState\Stripe\Fake\Traits\Listable;
use RandomState\Stripe\Fake\Traits\Retrievable;
use RandomState\Stripe\Fake\Traits\Updatable;

class Charges
{
    use Creatable, Retrievable, Updatable, Listable;

    public function getResourceClass()
    {
        return Charge::class;
    }

    public static function idPrefix()
    {
        return 'ch_';
    }
}