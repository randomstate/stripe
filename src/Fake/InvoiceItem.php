<?php


namespace RandomState\Stripe\Fake;


use RandomState\Stripe\Fake\Traits\Fake;

class InvoiceItem extends \Stripe\InvoiceItem
{
    use Fake;
}