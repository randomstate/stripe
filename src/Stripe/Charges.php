<?php


namespace RandomState\Stripe\Stripe;


use RandomState\Stripe\Stripe\Traits\CrudMethods;
use Stripe\Charge;

class Charges extends StripeResource
{
    use CrudMethods;

    public function getResourceClass()
    {
        return Charge::class;
    }
}