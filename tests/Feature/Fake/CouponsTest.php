<?php


namespace RandomState\Tests\Stripe\Feature\Fake;


use RandomState\Stripe\Fake\Coupons;
use RandomState\Tests\Stripe\Feature\Contracts\CouponsContractTests;
use RandomState\Tests\Stripe\TestCase;

class CouponsTest extends TestCase
{
    use CouponsContractTests;

    public function createClient()
    {
        return new Coupons;
    }
}