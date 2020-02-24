<?php


namespace RandomState\Tests\Stripe\Feature\Fake\Transformations;


use RandomState\Stripe\Fake\Plan;
use RandomState\Stripe\Fake\Subscriptions;
use RandomState\Tests\Stripe\TestCase;

class SubscriptionsTest extends TestCase
{
    /**
     * @test
     */
    public function plan_is_populated_for_subscriptions_with_only_one_item()
    {
       $subscriptions = $this->fake->subscriptions();
       $plan = $this->fake->plans()->create(['id' => '1234']);

       $subscription = $subscriptions->create([
          'items' => [
             [
                 'plan' => $plan->id,
             ]
          ]
       ]);

       $this->assertInstanceOf(Plan::class, $subscription->plan);
    }
}