<?php


namespace RandomState\Tests\Stripe\Feature\Fake;


use RandomState\Stripe\Fake\Charges;
use RandomState\Tests\Stripe\TestCase;

class GetResourcesDuringTest extends TestCase
{
    use \RandomState\Tests\Stripe\Feature\Contracts\GetResourcesDuringTest;

    public function createClient()
    {
        return new Charges;
    }


}