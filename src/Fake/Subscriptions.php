<?php


namespace RandomState\Stripe\Fake;


use RandomState\Stripe\Fake;
use RandomState\Stripe\Fake\Traits\CrudMethods;

class Subscriptions extends FakeClient implements \RandomState\Stripe\Contracts\Subscriptions
{
    use CrudMethods;

    protected $items;

    public function __construct(Fake $stripe, SubscriptionItems $items)
    {
        parent::__construct($stripe);
        $this->items = $items;
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