<?php


namespace RandomState\Tests\Stripe\Feature\Contracts;


use Stripe\Customer;

trait DiscountsContractTests
{
    abstract public function customersClient();
    abstract public function couponsClient();

    /**
     * @test
     */
    public function can_remove_a_discount_applied_to_a_customer()
    {
        $coupon = $this->couponsClient()->create([
            'id' => uniqid('test_coupon_'),
            'duration' => 'once',
            'percent_off' => 24.09,
        ]);

        /** @var Customer $customer */
        $customer = $this->customersClient()->create();
        $customer->coupon = $coupon->id;
        $customer->save();
        $customer->deleteDiscount();

        $this->assertNull($customer->discount);
    }
}