<?php


namespace RandomState\Tests\Stripe\Feature\Stripe;


use RandomState\Stripe\Stripe\Customers;
use RandomState\Stripe\Stripe\Events;
use RandomState\Stripe\Stripe\WebhookListener;
use RandomState\Tests\Stripe\TestCase;
use Stripe\Event;

class WebhooksTest extends TestCase
{
    /**
     * @var WebhookListener
     */
    protected $webhooks;

    protected function setUp()
    {
        parent::setUp();
        $this->webhooks = new WebhookListener(new Events(env("STRIPE_KEY")));
    }

    /**
     * @test
     */
    public function can_return_all_webhooks_that_have_happened_since_start_and_finish()
    {
        $this->webhooks->record();

        $customers = new Customers(env("STRIPE_KEY"));
        $customers->create();

        $events = $this->webhooks->play();

        $this->assertCount(1, $events);
    }

    /**
     * @test
     */
    public function can_return_all_webhooks_that_have_happened_within_closure()
    {
        $events = $this->webhooks->during(function () {
            $customers = new Customers(env("STRIPE_KEY"));
            $customers->create();
        });

        $this->assertCount(1, $events);
    }

    /**
     * @test
     */
    public function can_return_array_of_results_from_listening_action()
    {
        $listenerDidItsThing = false;

        $this->webhooks->listen(function(Event $event) use(&$listenerDidItsThing) {
            $listenerDidItsThing = true;
        });

        $this->webhooks->during(function() {
            $customers = new Customers(env("STRIPE_KEY"));
            $customers->create();
        });

        $this->assertTrue($listenerDidItsThing);
    }
}