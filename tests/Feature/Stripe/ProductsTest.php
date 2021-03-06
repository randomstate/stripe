<?php


namespace RandomState\Tests\Stripe\Feature\Stripe;


use RandomState\Stripe\Stripe\Products;
use RandomState\Tests\Stripe\Feature\Contracts\ProductsContractTests;
use RandomState\Tests\Stripe\TestCase;

/**
 * Class ProductsTest
 * @package RandomState\Tests\Stripe\Feature\Stripe
 *
 * @group integration
 */
class ProductsTest extends TestCase
{
    use ProductsContractTests;

    public function createClient()
    {
        return new Products(env("STRIPE_KEY"));
    }
}