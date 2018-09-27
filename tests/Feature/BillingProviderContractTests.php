<?php


namespace RandomState\Tests\Stripe\Feature;


use RandomState\Stripe\BillingProvider;
use RandomState\Stripe\Contracts\Cards;
use RandomState\Stripe\Contracts\Charges;
use RandomState\Stripe\Contracts\Coupons;
use RandomState\Stripe\Contracts\Customers;
use RandomState\Stripe\Contracts\Discounts;
use RandomState\Stripe\Contracts\Plans;
use RandomState\Stripe\Contracts\Products;
use RandomState\Stripe\Contracts\Refunds;
use RandomState\Stripe\Contracts\Sources;
use RandomState\Stripe\Contracts\SubscriptionItems;
use RandomState\Stripe\Contracts\Subscriptions;
use RandomState\Stripe\Contracts\Tokens;

trait BillingProviderContractTests
{
    abstract public function getProvider(): BillingProvider;

    /**
     * @test
     */
    public function has_charges_client()
    {
        $this->assertInstanceOf(Charges::class, $this->getProvider()->charges());
    }

    /**
     * @test
     */
    public function has_customers_client()
    {
        $this->assertInstanceOf(Customers::class, $this->getProvider()->customers());
    }

    /**
     * @test
     */
    public function has_products_client()
    {
        $this->assertInstanceOf(Products::class, $this->getProvider()->products());
    }

    /**
     * @test
     */
    public function has_refunds_client()
    {
        $this->assertInstanceOf(Refunds::class, $this->getProvider()->refunds());
    }

    /**
     * @test
     */
    public function has_tokens_client()
    {
        $this->assertInstanceOf(Tokens::class, $this->getProvider()->tokens());
    }

    /**
     * @test
     */
    public function has_sources_client()
    {
        $this->assertInstanceOf(Sources::class, $this->getProvider()->sources());
    }

    /**
     * @test
     */
    public function has_coupons_client()
    {
        $this->assertInstanceOf(Coupons::class, $this->getProvider()->coupons());
    }

    /**
     * @test
     */
    public function has_plans_client()
    {
        $this->assertInstanceOf(Plans::class, $this->getProvider()->plans());
    }

    /**
     * @test
     */
    public function has_subscriptions_client()
    {
        $this->assertInstanceOf(Subscriptions::class, $this->getProvider()->subscriptions());
    }

    /**
     * @test
     */
    public function has_subscription_items_client()
    {
        $this->assertInstanceOf(SubscriptionItems::class, $this->getProvider()->subscriptions()->items());
    }
}