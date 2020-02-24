<?php


namespace RandomState\Stripe\Fake;


use RandomState\Stripe\Fake\Traits\Fake;

class InvoiceLineItem extends \Stripe\InvoiceLineItem
{
    use Fake;
}