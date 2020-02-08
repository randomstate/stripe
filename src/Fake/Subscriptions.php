<?php


namespace RandomState\Stripe\Fake;


use RandomState\Stripe\Fake\Traits\CrudMethods;

class Subscriptions implements \RandomState\Stripe\Contracts\Subscriptions
{
    use CrudMethods;

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