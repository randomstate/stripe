<?php


namespace RandomState\Stripe\Fake;


use RandomState\Stripe\Fake\Traits\CrudMethods;

class InvoiceItems implements \RandomState\Stripe\Contracts\InvoiceItems
{
    use CrudMethods;

    public function getResourceClass()
    {
        return InvoiceItem::class;
    }

    public static function idPrefix()
    {
        return 'item_';
    }

}