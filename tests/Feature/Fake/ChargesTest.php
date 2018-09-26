<?php


namespace RandomState\Tests\Stripe\Feature\Fake;


use RandomState\Stripe\Fake\Charges;
use RandomState\Tests\Stripe\Feature\Contracts\ChargesContractTests;
use RandomState\Tests\Stripe\TestCase;

class ChargesTest extends TestCase
{
    use ChargesContractTests;

    protected $client;

    protected function setUp()
    {
        parent::setUp();
        $this->client = new Charges();
    }

    public function client()
    {
        return $this->client;
    }
}