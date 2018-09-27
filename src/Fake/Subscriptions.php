<?php


namespace RandomState\Stripe\Fake;


use RandomState\Stripe\Fake\Traits\Creatable;
use RandomState\Stripe\Fake\Traits\Deletable;
use RandomState\Stripe\Fake\Traits\Listable;
use RandomState\Stripe\Fake\Traits\Retrievable;
use RandomState\Stripe\Fake\Traits\Updatable;

class Subscriptions implements \RandomState\Stripe\Contracts\Subscriptions
{
    use Creatable, Retrievable, Updatable, Deletable, Listable;

    protected $items;

    public function __construct()
    {
        $this->items = new SubscriptionItems;
    }

    public static function idPrefix()
    {
        return "sub_";
    }

    public function getResourceClass()
    {
        return Subscription::class;
    }

    public function items()
    {
        return $this->items;
    }


}