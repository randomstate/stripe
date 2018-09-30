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
       $subscriptions = new Subscriptions;
       $subscription = $subscriptions->create([
          'items' => [
             [
                 'plan' => '1234',
             ]
          ]
       ]);

       $this->assertInstanceOf(Plan::class, $subscription->plan);
    }
}