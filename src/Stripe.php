<?php


namespace RandomState\Stripe;


use RandomState\Stripe\Stripe\Charges;
use RandomState\Stripe\Stripe\Coupons;
use RandomState\Stripe\Stripe\Customers;
use RandomState\Stripe\Stripe\Plans;
use RandomState\Stripe\Stripe\Products;
use RandomState\Stripe\Stripe\Refunds;
use RandomState\Stripe\Stripe\Sources;
use RandomState\Stripe\Stripe\StripeResourceClient;
use RandomState\Stripe\Stripe\Subscriptions;
use RandomState\Stripe\Stripe\Tokens;
use RandomState\Stripe\Stripe\UsageRecords;

class Stripe extends StripeResourceClient implements BillingProvider
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

    public function __construct($apiKey)
    {
        parent::__construct($apiKey);
        $this->charges = new Charges($this->apiKey);
        $this->customers = new Customers($this->apiKey);
        $this->products = new Products($this->apiKey);
        $this->refunds = new Refunds($this->apiKey);
        $this->tokens = new Tokens($this->apiKey);
        $this->sources = new Sources($this->apiKey);
        $this->coupons = new Coupons($this->apiKey);
        $this->plans = new Plans($this->apiKey);
        $this->subscriptions = new Subscriptions($this->apiKey);
        $this->usageRecords = new UsageRecords($this->apiKey);
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
}