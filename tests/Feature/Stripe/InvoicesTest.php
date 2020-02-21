<?php


namespace RandomState\Tests\Stripe\Feature\Stripe;


use RandomState\Stripe\Stripe\Customers;
use RandomState\Stripe\Stripe\InvoiceItems;
use RandomState\Stripe\Stripe\Invoices;
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
     * @var Customers
     */
    protected $customersClient;

    /**
     * @var InvoiceItems
     */
    protected $itemsClient;

    protected function setUp()
    {
        parent::setUp();
        $this->client = $this->getClient();
        $this->customersClient = $this->getCustomersClient();
        $this->itemsClient = $this->getInvoiceItemsClient();
    }

    protected function getClient()
    {
        return new Invoices(env("STRIPE_KEY"));
    }

    protected function getInvoiceItemsClient()
    {
        return new InvoiceItems(env("STRIPE_KEY"));
    }

    protected function getCustomersClient()
    {
        return new Customers(env("STRIPE_KEY"));
    }

}