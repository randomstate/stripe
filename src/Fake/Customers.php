<?php


namespace RandomState\Stripe\Fake;


use RandomState\Stripe\Fake\Traits\CrudMethods;

class Customers
{
    use CrudMethods;
    /**
     * @var Customer
     */
    protected $customers = [];

    public static function idPrefix()
    {
        return 'cust_';
    }

    public function getResourceClass()
    {
        return Customer::class;
    }
}