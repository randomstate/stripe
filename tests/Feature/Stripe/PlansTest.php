<?php


namespace RandomState\Tests\Stripe\Feature\Stripe;


use RandomState\Stripe\Stripe\Plans;
use RandomState\Stripe\Stripe\Products;
use RandomState\Tests\Stripe\Feature\Contracts\PlansContractTests;
use RandomState\Tests\Stripe\TestCase;

/**
 * Class PlansTest
 * @package RandomState\Tests\Stripe\Feature\Stripe
 *
 * @group integration
 */
class PlansTest extends TestCase
{
    use PlansContractTests;

    public function createClient()
    {
        return new Plans(env("STRIPE_KEY"));
    }

    public function createProductsClient()
    {
        return new Products(env("STRIPE_KEY"));
    }
}