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
        return new InvoiceItems();
    }

    public function createCustomersClient()
    {
        if($this->customersClient) {
            return $this->customersClient;
        }

        return $this->customersClient = new Customers();
    }


}