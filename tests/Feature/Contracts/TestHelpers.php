<?php


namespace RandomState\Tests\Stripe\Feature\Contracts;


trait TestHelpers
{
    protected function createTestPlan($overrides = [])
    {
        $product = $this->productsClient()->create([
            'name' => 'test product',
            'type' => 'service',
        ]);

        $plan = $this->plansClient()->create(array_merge([
            'product' => $product->id,
            'currency' => 'gbp',
            'interval' => 'month',
            'amount' => 10000,
            'trial_period_days' => 60,
        ], $overrides));

        return $plan;
    }

    protected function createTestSubscription()
    {
        $customer = $this->customersClient()->create();

        return $this->subscriptionsClient()->create([
            'customer' => $customer->id,
            'trial_from_plan' => true,
            'items' => [
                [
                    'plan' => ($plan = $this->createTestPlan())->id,
                    'quantity' => $quantity = rand(0, 10),
                ]
            ]
        ]);
    }
}