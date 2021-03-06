<?php


namespace RandomState\Tests\Stripe\Feature\Fake;


use RandomState\Stripe\Fake\Customers;
use RandomState\Stripe\Fake\PaymentMethods;
use RandomState\Tests\Stripe\Feature\Contracts\PaymentMethodsContractTests;
use RandomState\Tests\Stripe\TestCase;

class PaymentMethodsTest extends TestCase
{
    use PaymentMethodsContractTests;

    public function getPaymentMethodsClient()
    {
        return $this->fake->paymentMethods();
    }

    public function getCustomersClient()
    {
        return $this->fake->customers();
    }
}