<?php


namespace RandomState\Tests\Stripe\Feature\Contracts;


use Stripe\SubscriptionItem;

trait SubscriptionItemsContractTests
{
    use ClientTest, TestHelpers;

    abstract public function createClient();

    abstract public function subscriptionsClient();

    abstract public function customersClient();

    abstract public function plansClient();

    abstract public function productsClient();

    /**
     * @test
     */
    public function can_create_subscription_item_on_existing_subscription()
    {
        $plan = $this->createTestPlan();
        $subscription = $this->createTestSubscription();

        $item = $this->client()->create([
            'subscription' => $subscription->id,
            'plan' => $plan->id,
            'quantity' => 10,
        ]);

        $this->assertInstanceOf(SubscriptionItem::class, $item);
        $this->assertEquals($subscription->id, $item->subscription);
        $this->assertEquals($plan->id, $item->plan->id);
        $this->assertEquals(10, $item->quantity);
    }

    /**
     * @test
     */
    public function can_retrieve_a_subscription_item()
    {
        $plan = $this->createTestPlan();
        $subscription = $this->createTestSubscription();

        $item = $this->client()->create([
            'subscription' => $subscription->id,
            'plan' => $plan->id,
            'quantity' => 10,
        ]);

        $found = $this->client()->retrieve($item->id);

        $this->assertInstanceOf(SubscriptionItem::class, $found);
        $this->assertEquals($subscription->id, $found->subscription);
        $this->assertEquals($plan->id, $found->plan->id);
        $this->assertEquals(10, $found->quantity);
    }

    /**
     * @test
     */
    public function can_update_a_subscription_item()
    {
        $plan = $this->createTestPlan();
        $subscription = $this->createTestSubscription();

        $item = $this->client()->create([
            'subscription' => $subscription->id,
            'plan' => $plan->id,
            'quantity' => 10,
        ]);

        $updated = $this->client()->update($item->id, [
            'quantity' => 20,
        ]);

        $this->assertEquals($item->id, $updated->id);
        $this->assertEquals(20, $updated->quantity);
    }

    /**
     * @test
     */
    public function can_delete_a_subscription_item()
    {
        $plan = $this->createTestPlan();
        $subscription = $this->createTestSubscription();

        $item = $this->client()->create([
            'subscription' => $subscription->id,
            'plan' => $plan->id,
            'quantity' => 10,
        ]);

        $item->delete(); // can't check against anything other than no error thrown
        $this->assertTrue(true);
    }

    /**
     * @test
     */
    public function can_list_all_subscription_items()
    {
        $plan = $this->createTestPlan();
        $subscription = $this->createTestSubscription();

        $item = $this->client()->create([
            'subscription' => $subscription->id,
            'plan' => $plan->id,
            'quantity' => 10,
        ]);

        $items = $this->client()->all(['subscription' => $subscription->id]);

        $this->assertEquals($item->id, $items->data[count($items->data) - 1]->id);
    }


}