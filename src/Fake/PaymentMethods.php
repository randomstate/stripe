<?php


namespace RandomState\Stripe\Fake;


use RandomState\Stripe\Fake\Traits\Creatable;
use RandomState\Stripe\Fake\Traits\Listable;
use RandomState\Stripe\Fake\Traits\Retrievable;
use RandomState\Stripe\Fake\Traits\Updatable;

class PaymentMethods implements \RandomState\Stripe\Contracts\PaymentMethods
{
    use Creatable, Retrievable, Updatable, Listable;

    public function getResourceClass()
    {
        return PaymentMethod::class;
    }

    public static function idPrefix()
    {
        return 'pm_';
    }
}