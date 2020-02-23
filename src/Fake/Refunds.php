<?php


namespace RandomState\Stripe\Fake;


use RandomState\Stripe\Fake\Traits\Creatable;
use RandomState\Stripe\Fake\Traits\CruMethods;
use RandomState\Stripe\Fake\Traits\Listable;
use RandomState\Stripe\Fake\Traits\Retrievable;
use RandomState\Stripe\Fake\Traits\Updatable;

class Refunds extends FakeClient implements \RandomState\Stripe\Contracts\Refunds
{
    use CruMethods;

    public static function idPrefix()
    {
        return "ref_";
    }

    public function getResourceClass()
    {
        return Refund::class;
    }
}