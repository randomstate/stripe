<?php


namespace RandomState\Stripe\Stripe;


use RandomState\Stripe\Stripe\Traits\CrudMethods;
use Stripe\Product;

class Products extends StripeResourceClient implements \RandomState\Stripe\Contracts\Products
{
    use CrudMethods;

    public function getResourceClass()
    {
        return Product::class;
    }
}