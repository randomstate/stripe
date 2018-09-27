<?php


namespace RandomState\Stripe\Stripe;


use RandomState\Stripe\Stripe\Traits\CrudMethods;
use Stripe\Product;

class Products extends StripeResourceClient
{
    use CrudMethods;

    public function getResourceClass()
    {
        return Product::class;
    }
}