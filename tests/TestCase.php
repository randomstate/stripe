<?php


namespace RandomState\Tests\Stripe;


use RandomState\Stripe\Fake;

class TestCase extends \PHPUnit\Framework\TestCase
{
    /**
     * @var Fake
     */
    protected $fake;

    protected function setUp()
    {
        parent::setUp();
        $this->fake = new Fake();
    }
}