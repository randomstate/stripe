<?php


namespace RandomState\Tests\Stripe\Feature\Fake;


use RandomState\Stripe\Fake\Customers;
use RandomState\Stripe\Fake\InvoiceItems;
use RandomState\Stripe\Fake\Invoices;
use RandomState\Tests\Stripe\Feature\Contracts\InvoicesContractTests;
use RandomState\Tests\Stripe\TestCase;

class InvoicesTest extends TestCase
{
    use InvoicesContractTests;

    /**
     * @var Invoices
     */
    protected $client;

    /**
     * @var InvoiceItems
     */
    protected $invoiceItemsClient;

    /**
     * @var Customers
     */
    protected $customersClient;

    protected function setUp()
    {
        parent::setUp();
        $this->invoiceItemsClient = new InvoiceItems();
        $this->client = new Invoices($this->invoiceItemsClient);
        $this->customersClient = new Customers();
    }

    protected function getClient()
    {
        return $this->client;
    }

    protected function getInvoiceItemsClient()
    {
        return $this->invoiceItemsClient;
    }

    protected function getCustomersClient()
    {
        return $this->customersClient;
    }


}