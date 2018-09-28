<?php


namespace RandomState\Tests\Stripe\Feature\Stripe;


use RandomState\Stripe\Stripe\Charges;
use RandomState\Tests\Stripe\TestCase;

class GetResourcesDuringTest extends TestCase
{
    use \RandomState\Tests\Stripe\Feature\Contracts\GetResourcesDuringTest;

    public function createClient()
    {
        return new Charges(env("STRIPE_KEY"));
    }


}