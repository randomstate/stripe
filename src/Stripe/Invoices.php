<?php


namespace RandomState\Stripe\Stripe;


use RandomState\Stripe\Contracts\InvoiceItems;
use RandomState\Stripe\Stripe\Traits\Creatable;
use RandomState\Stripe\Stripe\Traits\Listable;
use RandomState\Stripe\Stripe\Traits\Retrievable;
use RandomState\Stripe\Stripe\Traits\Updatable;
use Stripe\Invoice;

class Invoices extends StripeResourceClient implements \RandomState\Stripe\Contracts\Invoices
{
    use Creatable, Updatable, Retrievable, Listable;

    public function getResourceClass()
    {
        return Invoice::class;
    }

    public function upcoming($params = [])
    {
        return Invoice::upcoming($params, $this->options());
    }

    public function items(): InvoiceItems
    {
        return new \RandomState\Stripe\Stripe\InvoiceItems($this->apiKey);
    }
}