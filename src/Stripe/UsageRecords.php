<?php


namespace RandomState\Stripe\Stripe;


use RandomState\Stripe\Stripe\Traits\Creatable;
use Stripe\UsageRecord;

class UsageRecords extends StripeResourceClient implements \RandomState\Stripe\Contracts\UsageRecords
{
    use Creatable;

    public function getResourceClass()
    {
        return UsageRecord::class;
    }
}