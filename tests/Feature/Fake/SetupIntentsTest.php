<?php


namespace RandomState\Tests\Stripe\Feature\Fake;


use RandomState\Stripe\Fake\SetupIntents;
use RandomState\Tests\Stripe\Feature\Contracts\SetupIntentsContractTest;
use RandomState\Tests\Stripe\TestCase;

class SetupIntentsTest extends TestCase
{
    use SetupIntentsContractTest;

    public function createClient()
    {
        return $this->fake->setupIntents();
    }
}