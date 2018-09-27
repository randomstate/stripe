<?php


namespace RandomState\Stripe\Stripe;


use RandomState\Stripe\Stripe\Traits\CrudMethods;
use Stripe\Customer;

class Customers extends StripeResourceClient implements \RandomState\Stripe\Contracts\Customers
{
    use CrudMethods;

    public function getResourceClass()
    {
        return Customer::class;
    }
}