<?php


namespace RandomState\Stripe\Fake;


use RandomState\Stripe\Fake\Traits\CruMethods;

class Charges extends FakeClient implements \RandomState\Stripe\Contracts\Charges
{
    use CruMethods;

    public function getResourceClass()
    {
        return Charge::class;
    }

    public static function idPrefix()
    {
        return 'ch_';
    }
}
