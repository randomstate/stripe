<?php


namespace RandomState\Stripe\Stripe;


use RandomState\Stripe\Stripe\Traits\CrudMethods;
use Stripe\SubscriptionItem;

class SubscriptionItems extends StripeResourceClient implements \RandomState\Stripe\Contracts\SubscriptionItems
{
    use CrudMethods;

    public function getResourceClass()
    {
        return SubscriptionItem::class;
    }


}