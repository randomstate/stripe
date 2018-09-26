<?php


namespace RandomState\Tests\Stripe\Feature\Stripe;


use RandomState\Stripe\Stripe\Charges;
use RandomState\Tests\Stripe\Feature\Contracts\ChargesContractTests;
use RandomState\Tests\Stripe\TestCase;

/**
 * Class ChargesTest
 * @package RandomState\Tests\Stripe\Feature\Stripe
 * @group integration
 */
class ChargesTest extends TestCase
{
    use ChargesContractTests;

    /**
     * @var Charges()
     */
    protected $client;

    protected function setUp()
    {
        parent::setUp();
        $this->client = new Charges(env("STRIPE_KEY"));
    }

    public function client()
    {
        return $this->client;
    }
}