<?php


namespace RandomState\Stripe\Stripe;


use RandomState\Stripe\Stripe\Traits\CrudMethods;
use Stripe\Customer;

class Customers extends StripeResourceClient
{
    use CrudMethods;

    public function getResourceClass()
    {
        return Customer::class;
    }
}