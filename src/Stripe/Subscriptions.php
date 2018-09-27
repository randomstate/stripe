<?php


namespace RandomState\Stripe\Stripe;


use RandomState\Stripe\Stripe\Traits\Creatable;
use RandomState\Stripe\Stripe\Traits\Listable;
use RandomState\Stripe\Stripe\Traits\Retrievable;
use RandomState\Stripe\Stripe\Traits\Updatable;
use Stripe\Subscription;

class Subscriptions extends StripeResourceClient
{
    use Creatable, Updatable, Listable, Retrievable;

    public function getResourceClass()
    {
        return Subscription::class;
    }
}