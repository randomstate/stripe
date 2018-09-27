<?php


namespace RandomState\Tests\Stripe\Feature\Fake;


use RandomState\Stripe\Fake\Charges;
use RandomState\Tests\Stripe\Feature\Contracts\ChargesContractTests;
use RandomState\Tests\Stripe\TestCase;

class ChargesTest extends TestCase
{
    use ChargesContractTests;

    public function createClient()
    {
        return new Charges();
    }
}