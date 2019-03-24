<?php


namespace RandomState\Tests\Stripe\Feature\Stripe;


use RandomState\Stripe\Stripe;
use RandomState\Stripe\Stripe\Customers;
use RandomState\Stripe\Stripe\Events;
use RandomState\Stripe\Stripe\WebhookListener;
use RandomState\Stripe\Stripe\WebhookSigner;
use RandomState\Tests\Stripe\TestCase;
use Stripe\Event;
use Stripe\Webhook;


/**
 * Class WebhooksTest
 * @package RandomState\Tests\Stripe\Feature\Stripe
 *
 * @group integration
 */
class WebhooksTest extends TestCase
{
    /**
     * @var WebhookListener
     */
    protected $webhooks;

    protected function setUp()
    {
        parent::setUp();
        $this->webhooks = new WebhookListener(
            new Events(env("STRIPE_KEY")),
            new WebhookSigner(env("STRIPE_SIGNING_KEY"))
        );
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

    /**
     * @test
     */
    public function stripe_client_has_events_factory_method()
    {
        $stripe = new Stripe(env("STRIPE_KEY"));

        $this->assertInstanceOf(Events::class, $stripe->events());
    }

    /**
     * @test
     */
    public function webhook_listener_provides_valid_signature()
    {
        $event = null;
        $signatureGenerated = null;

        $this->webhooks->listen(function(Event $generatedEvent, $signature) use(&$event, &$signatureGenerated) {
            $signatureGenerated = $signature;
            $event = $generatedEvent;
        });

        $this->webhooks->during(function() {
            $customers = new Customers(env("STRIPE_KEY"));
            $customers->create();
        });

        Webhook::constructEvent(json_encode($event->jsonSerialize()), $signatureGenerated, env("STRIPE_SIGNING_KEY"));
        $valid = true;

        $this->assertTrue($valid);
    }

    /**
     * @test
     */
    public function webhooks_can_fire_to_different_listeners()
    {
        $called = 0;

        $this->webhooks->listen(function(Event $generatedEvent, $signature) use(&$called) {
            $called++;
        });

        $this->webhooks->listen(function(Event $generatedEvent, $signature) use(&$called) {
            $called++;
        });

        $this->webhooks->during(function() {
           $customers = new Customers(env("STRIPE_KEY"));
           $customers->create();
        });

        $this->assertEquals(2, $called);
    }

    /**
     * @test
     */
    public function events_are_in_order_of_creation_not_newest_first()
    {
        $listened = [];

        $this->webhooks->listen(function(Event $generatedEvent, $signature) use(&$listened) {
            $listened[] = $generatedEvent->type;
        });

        $this->webhooks->during(function() {
            $customers = new Customers(env("STRIPE_KEY"));
            $customer = $customers->create();

            $customer->delete();
        });

        $this->assertEquals('customer.created', $listened[0]);
        $this->assertEquals('customer.deleted', $listened[1]);
    }
}