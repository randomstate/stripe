<?php


namespace RandomState\Stripe\Fake;


use RandomState\Stripe\Fake\Traits\Creatable;
use RandomState\Stripe\Fake\Traits\Listable;

class UsageRecords extends FakeClient implements \RandomState\Stripe\Contracts\UsageRecords
{
    use Creatable;

    public function getResourceClass()
    {
        return UsageRecord::class;
    }

    public static function idPrefix()
    {
        return 'mbur_';
    }


}