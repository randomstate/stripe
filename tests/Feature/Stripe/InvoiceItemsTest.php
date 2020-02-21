<?php


namespace RandomState\Tests\Stripe\Feature\Stripe;


use RandomState\Stripe\Stripe\Customers;
use RandomState\Stripe\Stripe\InvoiceItems;
use RandomState\Tests\Stripe\Feature\Contracts\InvoiceItemsContractTests;
use RandomState\Tests\Stripe\TestCase;

class InvoiceItemsTest extends TestCase
{
    use InvoiceItemsContractTests;

    public function createClient()
    {
        return new InvoiceItems(env("STRIPE_KEY"));
    }

    public function createCustomersClient()
    {
        return new Customers(env("STRIPE_KEY"));
    }
}