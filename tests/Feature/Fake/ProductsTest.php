<?php


namespace RandomState\Tests\Stripe\Feature\Fake;


use RandomState\Stripe\Fake\Products;
use RandomState\Tests\Stripe\Feature\Contracts\ProductsContractTests;
use RandomState\Tests\Stripe\TestCase;

class ProductsTest extends TestCase
{
    use ProductsContractTests;

    public function createClient()
    {
        return new Products;
    }
}