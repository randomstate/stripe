<?php


namespace RandomState\Stripe\Fake;


use RandomState\Stripe\Fake\Traits\CrudMethods;

class Products extends FakeClient implements \RandomState\Stripe\Contracts\Products
{
    use CrudMethods;

    public function getResourceClass()
    {
        return Product::class;
    }

    public static function idPrefix()
    {
        return 'prod_';
    }

}