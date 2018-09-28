<?php


namespace RandomState\Tests\Stripe\Feature\Contracts;


use Stripe\Customer;

trait DiscountsContractTests
{
    abstract public function customersClient();
    abstract public function couponsClient();
    abstract public function subscriptionsClient();
    abstract public function plansClient();
    abstract public function productsClient();

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

    /**
     * @test
     */
    public function can_remove_a_discount_applied_to_a_subscription()
    {
        $coupon = $this->couponsClient()->create([
            'id' => uniqid('test_coupon_'),
            'duration' => 'once',
            'percent_off' => 24.09,
        ]);

        $customer = $this->customersClient()->create();

        $subscription = $this->subscriptionsClient()->create([
            'customer' => $customer->id,
            'trial_from_plan' => true,
            'items' => [
                [
                    'plan' => ($plan = $this->createTestPlan())->id,
                    'quantity' => $quantity = rand(0, 10),
                ]
            ]
        ]);

        $subscription->coupon = $coupon->id;
        $subscription->save();

        $subscription->deleteDiscount();
        $this->assertNull($subscription->discount);
    }

    protected function createTestPlan()
    {
        $product = $this->productsClient()->create([
            'name' => 'test product',
            'type' => 'service',
        ]);

        $plan = $this->plansClient()->create([
            'product' => $product->id,
            'currency' => 'gbp',
            'interval' => 'month',
            'amount' => 10000,
            'trial_period_days' => 60,
        ]);

        return $plan;
    }
}