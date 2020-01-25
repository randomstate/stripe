<?php


namespace RandomState\Tests\Stripe\Feature\Stripe;


use RandomState\Stripe\Stripe\Customers;
use RandomState\Stripe\Stripe\PaymentMethods;
use RandomState\Tests\Stripe\Feature\Contracts\PaymentMethodsContractTests;
use RandomState\Tests\Stripe\TestCase;

class PaymentMethodsTest extends TestCase
{
    use PaymentMethodsContractTests;

    public function getPaymentMethodsClient()
    {
        return new PaymentMethods(env("STRIPE_KEY"));
    }

    public function getCustomersClient()
    {
        return new Customers(env("STRIPE_KEY"));
    }
}