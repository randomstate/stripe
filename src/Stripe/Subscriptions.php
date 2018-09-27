<?php


namespace RandomState\Stripe\Stripe;


use RandomState\Stripe\Stripe\Traits\Creatable;
use RandomState\Stripe\Stripe\Traits\Listable;
use RandomState\Stripe\Stripe\Traits\Retrievable;
use RandomState\Stripe\Stripe\Traits\Updatable;
use Stripe\Subscription;

class Subscriptions extends StripeResourceClient implements \RandomState\Stripe\Contracts\Subscriptions
{
    use Creatable, Updatable, Listable, Retrievable;

    public function getResourceClass()
    {
        return Subscription::class;
    }

    public function items()
    {
        return new SubscriptionItems($this->apiKey);
    }
}