<?php


namespace RandomState\Tests\Stripe\Feature\Fake;


use RandomState\Stripe\Contracts\Subscriptions;
use RandomState\Stripe\Fake\Subscription;
use RandomState\Stripe\Fake\Traits\CrudMethods;
use RandomState\Stripe\Fake\Traits\RuntimeExpansions;
use RandomState\Tests\Stripe\TestCase;
use Stripe\ApiResource;
use Stripe\Invoice;
use Stripe\PaymentIntent;

class ExpansionsTest extends TestCase
{
    /**
     * @test
     */
    public function can_expand_a_property()
    {
        $client = new ExpandableSubscriptionClient(ExpandableSubscription::class);
        $subscription = $client->create([
            'expand' => ['latest_invoice'],
        ]);

        $this->assertInstanceOf(Invoice::class, $subscription->latest_invoice);
    }

    /**
     * @test
     */
    public function fails_if_method_undefined_for_expansion()
    {
        try {
            $client = new ExpandableSubscriptionClient(ExpandableSubscription::class);

            $client->create([
                'expand' => ['non_existant'],
            ]);

            $this->fail();
        } catch(\Throwable $e) {
            $this->assertContains('Undefined method', $e->getMessage());
        }
    }

    /**
     * @test
     */
    public function can_expand_nested_property()
    {
        $client = new ExpandableSubscriptionClient(ExpandableSubscription::class);
        $subscription = $client->create([
            'expand' => ['latest_invoice.payment_intent'],
        ]);

        $this->assertInstanceOf(PaymentIntent::class, $subscription->latest_invoice->payment_intent);
    }

    /**
     * @test
     */
    public function can_define_expander_on_runtime_expandable_classes()
    {
        $client = new ExpandableSubscriptionClient(RuntimeExpandableResource::class);
        RuntimeExpandableResource::expand('my_custom_thing', function() {
            return ExpandableInvoice::constructFrom([]);
        });

        $resource = $client->create([
            'expand' => ['my_custom_thing'],
        ]);

        $this->assertInstanceOf(ExpandableInvoice::class, $resource->my_custom_thing);
    }
}

class ExpandableSubscriptionClient implements Subscriptions {
    use CrudMethods;

    protected $resourceClass;

    public function __construct($resourceClass)
    {
        $this->resourceClass = $resourceClass;
    }

    public function getResourceClass()
    {
        return $this->resourceClass;
    }

    public static function idPrefix()
    {
        return 'sub_';
    }

    public function items(){}
}

class ExpandableSubscription extends Subscription {
    public function expandLatestInvoice()
    {
        return ExpandableInvoice::constructFrom([]);
    }
};

class ExpandableInvoice extends Invoice {
    public function expandPaymentIntent()
    {
        return PaymentIntent::constructFrom(['id' => 'pi_1234']);
    }
}

class RuntimeExpandableResource extends ApiResource {
    use RuntimeExpansions;
}