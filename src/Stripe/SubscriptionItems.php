<?php


namespace RandomState\Stripe\Stripe;


use RandomState\Stripe\Stripe\Traits\Creatable;
use RandomState\Stripe\Stripe\Traits\Deletable;
use RandomState\Stripe\Stripe\Traits\Listable;
use RandomState\Stripe\Stripe\Traits\Retrievable;
use RandomState\Stripe\Stripe\Traits\Updatable;
use Stripe\SubscriptionItem;

class SubscriptionItems extends StripeResourceClient
{
    use Creatable, Retrievable, Updatable, Deletable, Listable;

    public function getResourceClass()
    {
        return SubscriptionItem::class;
    }


}