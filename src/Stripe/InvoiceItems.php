<?php


namespace RandomState\Stripe\Stripe;


use RandomState\Stripe\Stripe\Traits\CrudMethods;
use Stripe\InvoiceItem;

class InvoiceItems extends StripeResourceClient implements \RandomState\Stripe\Contracts\InvoiceItems
{
    use CrudMethods;

    public function getResourceClass()
    {
        return InvoiceItem::class;
    }
}