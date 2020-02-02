<?php


namespace RandomState\Tests\Stripe\Feature\Stripe;


use RandomState\Stripe\Stripe\SetupIntents;
use RandomState\Tests\Stripe\Feature\Contracts\SetupIntentsContractTest;
use RandomState\Tests\Stripe\TestCase;

class SetupIntentsTest extends TestCase
{
    use SetupIntentsContractTest;

    /**
     * @return SetupIntents
     */
    public function createClient()
    {
        return new SetupIntents(env("STRIPE_KEY"));
    }
}