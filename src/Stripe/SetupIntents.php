<?php


namespace RandomState\Stripe\Stripe;


use RandomState\Stripe\Stripe\Traits\CrudMethods;
use Stripe\SetupIntent;

class SetupIntents extends StripeResourceClient implements \RandomState\Stripe\Contracts\SetupIntents
{
    use CrudMethods;

    public function getResourceClass()
    {
        return SetupIntent::class;
    }

}