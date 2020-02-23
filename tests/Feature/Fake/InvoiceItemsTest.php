<?php


namespace RandomState\Tests\Stripe\Feature\Fake;


use RandomState\Stripe\Fake\Customers;
use RandomState\Stripe\Fake\InvoiceItems;
use RandomState\Tests\Stripe\Feature\Contracts\InvoiceItemsContractTests;
use RandomState\Tests\Stripe\TestCase;

class InvoiceItemsTest extends TestCase
{
    use InvoiceItemsContractTests;

    public function createClient()
    {
        return $this->fake->invoices()->items();
    }

    public function createCustomersClient()
    {
        return $this->fake->customers();
    }


}