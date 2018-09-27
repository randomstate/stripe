<?php


namespace RandomState\Stripe\Stripe;


use RandomState\Stripe\Stripe\Traits\Creatable;
use RandomState\Stripe\Stripe\Traits\Retrievable;
use RandomState\Stripe\Stripe\Traits\Updatable;
use Stripe\Source;

class Sources extends StripeResourceClient
{
    use Creatable, Retrievable, Updatable;

    public function getResourceClass()
    {
        return Source::class;
    }
}