<?php


namespace RandomState\Stripe;


use RandomState\Stripe\Fake\Charges;
use RandomState\Stripe\Fake\Coupons;
use RandomState\Stripe\Fake\Customers;
use RandomState\Stripe\Fake\InvoiceItems;
use RandomState\Stripe\Fake\Invoices;
use RandomState\Stripe\Fake\PaymentMethods;
use RandomState\Stripe\Fake\Plans;
use RandomState\Stripe\Fake\Products;
use RandomState\Stripe\Fake\Refunds;
use RandomState\Stripe\Fake\SetupIntents;
use RandomState\Stripe\Fake\Sources;
use RandomState\Stripe\Fake\SubscriptionItems;
use RandomState\Stripe\Fake\Subscriptions;
use RandomState\Stripe\Fake\Tokens;
use RandomState\Stripe\Fake\UsageRecords;
use Stripe\Stripe;
use Stripe\Util\DefaultLogger;
use Stripe\Util\LoggerInterface;

class Fake implements BillingProvider
{
    protected $charges;
    protected $customers;
    protected $products;
    protected $refunds;
    protected $tokens;
    protected $sources;
    protected $coupons;
    protected $plans;
    protected $subscriptions;
    protected $usageRecords;
    protected $paymentMethods;
    protected $setupIntents;
    protected $invoices;

    public function __construct()
    {
        Stripe::$logger = (new class implements LoggerInterface
        {
            public function error($message, array $context = [])
            {
                if (strpos($message, 'Undefined property') > -1) {
                    return;
                }

                (new DefaultLogger)->error($message, $context);
            }
        });

        $this->charges = new Charges($this);
        $this->customers = new Customers($this);
        $this->products = new Products($this);
        $this->refunds = new Refunds($this);
        $this->tokens = new Tokens($this);
        $this->sources = new Sources($this);
        $this->coupons = new Coupons($this);
        $this->plans = new Plans($this);
        $this->subscriptions = new Subscriptions($this, new SubscriptionItems($this));
        $this->usageRecords = new UsageRecords($this);
        $this->paymentMethods = new PaymentMethods($this);
        $this->setupIntents = new SetupIntents($this);
        $this->invoices = new Invoices($this, new InvoiceItems($this));
    }

    public function charges()
    {
        return $this->charges;
    }

    public function customers()
    {
        return $this->customers;
    }

    public function products()
    {
        return $this->products;
    }

    public function refunds()
    {
        return $this->refunds;
    }

    public function tokens()
    {
        return $this->tokens;
    }

    public function sources()
    {
        return $this->sources;
    }

    public function coupons()
    {
        return $this->coupons;
    }

    public function plans()
    {
        return $this->plans;
    }

    public function subscriptions()
    {
        return $this->subscriptions;
    }

    public function usageRecords()
    {
        return $this->usageRecords;
    }

    public function paymentMethods()
    {
        return $this->paymentMethods;
    }

    public function setupIntents()
    {
        return $this->setupIntents;
    }

    public function invoices()
    {
        return $this->invoices;
    }
}
