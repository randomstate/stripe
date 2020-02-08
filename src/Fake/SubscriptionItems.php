<?php


namespace RandomState\Stripe\Fake;


use RandomState\Stripe\Fake\Traits\Creatable;
use RandomState\Stripe\Fake\Traits\CrudMethods;
use RandomState\Stripe\Fake\Traits\Deletable;
use RandomState\Stripe\Fake\Traits\Listable;
use RandomState\Stripe\Fake\Traits\Retrievable;
use RandomState\Stripe\Fake\Traits\Updatable;

class SubscriptionItems implements \RandomState\Stripe\Contracts\SubscriptionItems
{
    use CrudMethods;

    public static function idPrefix()
    {
        return SubscriptionItem::idPrefix();
    }

    public function getResourceClass()
    {
        return SubscriptionItem::class;
    }


}