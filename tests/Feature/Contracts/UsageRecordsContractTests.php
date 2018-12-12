<?php


namespace RandomState\Tests\Stripe\Feature\Contracts;


use Stripe\UsageRecord;

trait UsageRecordsContractTests
{
    use TestHelpers;

    /**
     * @test
     */
    public function can_create_a_usage_record()
    {
        $plan = $this->createTestPlan([
            'usage_type' => 'metered',
        ]);

        $subscription = $this->createTestSubscription();

        $item = $this->subscriptionItemsClient()->create([
            'subscription' => $subscription->id,
            'plan' => $plan->id,
        ]);

        $usageRecord = $this->client()->create([
            'quantity' => 40,
            'subscription_item' => $item->id,
            'timestamp' => ($time = (new \DateTime)->getTimestamp()),
        ]);

        $this->assertInstanceOf(UsageRecord::class, $usageRecord);
        $this->assertEquals(40, $usageRecord->quantity);
        $this->assertEquals($item->id, $usageRecord->subscription_item);
        $this->assertEquals($time, $usageRecord->timestamp);
    }

    abstract public function createClient();
    abstract public function subscriptionsClient();
    abstract public function subscriptionItemsClient();
    abstract public function customersClient();
    abstract public function plansClient();
    abstract public function productsClient();
}