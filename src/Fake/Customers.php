<?php


namespace RandomState\Stripe\Fake;


use RandomState\Stripe\Fake;
use RandomState\Stripe\Fake\Traits\CrudMethods;

class Customers extends FakeClient implements \RandomState\Stripe\Contracts\Customers
{
    use CrudMethods;
    /**
     * @var Customer
     */
    protected $customers = [];

    public function __construct(Fake $stripe)
    {
        parent::__construct($stripe);

        $this->onCreate[] = function(Customer $customer) {
            $customer->setSourcesClient($this->stripe->sources());
        };
    }

    public static function idPrefix()
    {
        return 'cust_';
    }

    public function getResourceClass()
    {
        return Customer::class;
    }
}