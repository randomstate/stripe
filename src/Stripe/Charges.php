<?php


namespace RandomState\Stripe\Stripe;


use RandomState\Stripe\Stripe\Traits\Creatable;
use RandomState\Stripe\Stripe\Traits\Listable;
use RandomState\Stripe\Stripe\Traits\Retrievable;
use RandomState\Stripe\Stripe\Traits\Updatable;
use Stripe\Charge;

class Charges extends StripeResourceClient implements \RandomState\Stripe\Contracts\Charges
{
    use Creatable, Retrievable, Updatable, Listable;

    public function getResourceClass()
    {
        return Charge::class;
    }
}