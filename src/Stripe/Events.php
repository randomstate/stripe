<?php


namespace RandomState\Stripe\Stripe;


use RandomState\Stripe\Stripe\Traits\Listable;
use RandomState\Stripe\Stripe\Traits\Retrievable;
use Stripe\Event;

class Events extends StripeResourceClient
{
    use Retrievable, Listable;

    public function getResourceClass()
    {
        return Event::class;
    }
}