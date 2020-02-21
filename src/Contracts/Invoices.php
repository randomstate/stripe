<?php


namespace RandomState\Stripe\Contracts;


interface Invoices extends Creatable, Updatable, Retrievable, Listable
{
    public function items() : InvoiceItems;
}