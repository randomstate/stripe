<?php


namespace RandomState\Stripe\Fake;


use RandomState\Stripe\Fake\Traits\Creatable;
use RandomState\Stripe\Fake\Traits\Listable;
use RandomState\Stripe\Fake\Traits\Retrievable;
use RandomState\Stripe\Fake\Traits\Updatable;

class Refunds
{
    use Creatable, Retrievable, Updatable, Listable;

    public static function idPrefix()
    {
        return "ref_";
    }

    public function getResourceClass()
    {
        return Refund::class;
    }
}