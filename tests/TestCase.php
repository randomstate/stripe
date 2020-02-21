<?php


namespace RandomState\Tests\Stripe;


use RandomState\Stripe\Fake;

class TestCase extends \PHPUnit\Framework\TestCase
{
    protected function setUp()
    {
        parent::setUp();
        new Fake();
    }
}