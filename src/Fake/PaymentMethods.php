<?php


namespace RandomState\Stripe\Fake;


use RandomState\Stripe\Fake\Traits\CruMethods;

class PaymentMethods implements \RandomState\Stripe\Contracts\PaymentMethods
{
    use CruMethods;

    public function getResourceClass()
    {
        return PaymentMethod::class;
    }

    public static function idPrefix()
    {
        return 'pm_';
    }
}