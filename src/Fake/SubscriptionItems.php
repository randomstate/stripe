<?php


namespace RandomState\Stripe\Fake;


use RandomState\Stripe\Fake\Traits\Creatable;
use RandomState\Stripe\Fake\Traits\Deletable;
use RandomState\Stripe\Fake\Traits\Listable;
use RandomState\Stripe\Fake\Traits\Retrievable;
use RandomState\Stripe\Fake\Traits\Updatable;

class SubscriptionItems
{
    use Creatable, Retrievable, Updatable, Deletable, Listable;

    public static function idPrefix()
    {
        return 'si_';
    }

    public function getResourceClass()
    {
        return SubscriptionItem::class;
    }


}