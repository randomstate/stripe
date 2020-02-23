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
        return $this->fake->plans();
    }

    public function createProductsClient()
    {
        return $this->fake->products();
    }


}