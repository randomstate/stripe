<?php


namespace RandomState\Stripe\Stripe;


use RandomState\Stripe\Stripe\Traits\CrudMethods;
use Stripe\Plan;

class Plans extends StripeResourceClient
{
    use CrudMethods;

    public function getResourceClass()
    {
        return Plan::class;
    }


}