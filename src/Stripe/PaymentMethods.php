<?php


namespace RandomState\Stripe\Stripe;


use RandomState\Stripe\Stripe\Traits\CrudMethods;
use Stripe\PaymentMethod;

class PaymentMethods extends StripeResourceClient implements \RandomState\Stripe\Contracts\PaymentMethods
{
    use CrudMethods;

    public function getResourceClass()
    {
        return PaymentMethod::class;
    }
}