<?php


namespace RandomState\Stripe\Stripe;


use RandomState\Stripe\Stripe\Traits\Creatable;
use RandomState\Stripe\Stripe\Traits\Listable;
use RandomState\Stripe\Stripe\Traits\Updatable;
use Stripe\Refund;

class Refunds extends StripeResourceClient
{
    use Creatable, Updatable, Listable;

    public function getResourceClass()
    {
        return Refund::class;
    }

}