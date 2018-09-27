<?php


namespace RandomState\Tests\Stripe\Feature\Fake;


use RandomState\Stripe\Fake\Plans;
use RandomState\Stripe\Fake\Products;
use RandomState\Tests\Stripe\Feature\Contracts\PlansContractTests;
use RandomState\Tests\Stripe\TestCase;

class PlansTest extends TestCase
{
    use PlansContractTests;

    public function createClient()
    {
        return new Plans;
    }

    public function createProductsClient()
    {
        return new Products;
    }


}