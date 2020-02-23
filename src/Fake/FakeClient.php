<?php


namespace RandomState\Stripe\Fake;


use RandomState\Stripe\Fake;

abstract class FakeClient
{
    /**
     * @var Fake
     */
    protected $stripe;

    public function __construct(Fake $stripe)
    {
        $this->stripe = $stripe;
    }
}