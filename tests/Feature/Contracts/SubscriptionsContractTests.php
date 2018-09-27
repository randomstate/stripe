<?php


namespace RandomState\Tests\Stripe\Feature\Contracts;


use Stripe\Subscription;

trait SubscriptionsContractTests
{
    use ClientTest;

    abstract public function createClient();

    abstract public function customersClient();

    abstract public function plansClient();

    abstract public function productsClient();

    /**
     * @test
     */
    public function can_create_a_subscription()
    {
        $customer = $this->customersClient()->create();

        $subscription = $this->client()->create([
            'customer' => $customer->id,
            'trial_from_plan' => true,
            'items' => [
                [
                    'plan' => ($plan = $this->createTestPlan())->id,
                    'quantity' => $quantity = rand(0, 10),
                ]
            ]
        ]);

        $this->assertInstanceOf(Subscription::class, $subscription);
        $this->assertEquals($quantity, $subscription->items->data[0]->quantity);
        $this->assertEquals($plan->id, $subscription->items->data[0]->plan->id);
    }

    /**
     * @test
     */
    public function can_retrieve_a_subscription()
    {
        $customer = $this->customersClient()->create();

        $subscription = $this->client()->create([
            'customer' => $customer->id,
            'trial_from_plan' => true,
            'items' => [
                [
                    'plan' => $this->createTestPlan(),
                    'quantity' => 1,
                ]
            ]
        ]);

        $found = $this->client()->retrieve($subscription->id);
        $this->assertEquals($subscription->id, $found->id);
    }

    /**
     * @test
     */
    public function can_update_a_subscription()
    {
        $customer = $this->customersClient()->create();

        $subscription = $this->client()->create([
            'customer' => $customer->id,
            'trial_from_plan' => true,
            'items' => [
                [
                    'plan' => $this->createTestPlan(),
                    'quantity' => 1,
                ]
            ]
        ]);

        $updated = $this->client()->update($subscription->id, [
            'cancel_at_period_end' => true,
        ]);

        $this->assertEquals($subscription->id, $updated->id);
        $this->assertTrue($updated->cancel_at_period_end);
    }

    /**
     * @test
     */
    public function can_cancel_a_subscription()
    {
        $customer = $this->customersClient()->create();

        $subscription = $this->client()->create([
            'customer' => $customer->id,
            'trial_from_plan' => true,
            'items' => [
                [
                    'plan' => $this->createTestPlan(),
                    'quantity' => 1,
                ]
            ]
        ]);

        $cancelled = $subscription->cancel();

        $this->assertEquals('canceled', $cancelled->status);
    }

    /**
     * @test
     */
    public function can_list_all_subscriptions()
    {
        $customer = $this->customersClient()->create();

        $subscription = $this->client()->create([
            'customer' => $customer->id,
            'trial_from_plan' => true,
            'items' => [
                [
                    'plan' => $this->createTestPlan(),
                    'quantity' => 1,
                ]
            ]
        ]);

        $subscriptions = $this->client()->all();
        $this->assertEquals($subscription->id, $subscriptions->data[0]->id);
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