<?php


namespace RandomState\Tests\Stripe\Feature\Stripe;


use RandomState\Stripe\Stripe\Charges;
use RandomState\Tests\Stripe\TestCase;

/**
 * Class GetResourcesDuringTest
 * @package RandomState\Tests\Stripe\Feature\Stripe
 *
 * @group integration
 */
class GetResourcesDuringTest extends TestCase
{
    use \RandomState\Tests\Stripe\Feature\Contracts\GetResourcesDuringTest;

    public function createClient()
    {
        return new Charges(env("STRIPE_KEY"));
    }


}