<?php


namespace RandomState\Stripe\Stripe;


use RandomState\Stripe\Stripe\Traits\Creatable;
use RandomState\Stripe\Stripe\Traits\Listable;
use RandomState\Stripe\Stripe\Traits\Retrievable;
use RandomState\Stripe\Stripe\Traits\Updatable;
use Stripe\Refund;

class Refunds extends StripeResourceClient implements \RandomState\Stripe\Contracts\Refunds
{
    use Creatable, Retrievable, Updatable, Listable;

    public function getResourceClass()
    {
        return Refund::class;
    }

}