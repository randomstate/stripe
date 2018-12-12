<?php

namespace RandomState\Stripe;

use RandomState\Stripe\Contracts\Charges;
use RandomState\Stripe\Contracts\Coupons;
use RandomState\Stripe\Contracts\Customers;
use RandomState\Stripe\Contracts\Plans;
use RandomState\Stripe\Contracts\Products;
use RandomState\Stripe\Contracts\Refunds;
use RandomState\Stripe\Contracts\Sources;
use RandomState\Stripe\Contracts\SubscriptionItems;
use RandomState\Stripe\Contracts\Tokens;
use RandomState\Stripe\Contracts\UsageRecords;

interface BillingProvider
{
    /**
     * @return Charges
     */
    public function charges();

    /**
     * @return Customers
     */
    public function customers();

    /**
     * @return Products
     */
    public function products();

    /**
     * @return Refunds
     */
    public function refunds();

    /**
     * @return Tokens
     */
    public function tokens();

    /**
     * @return Sources
     */
    public function sources();

    /**
     * @return Coupons
     */
    public function coupons();

    /**
     * @return Plans
     */
    public function plans();

    /**
     * @return SubscriptionItems
     */
    public function subscriptions();

    /**
     * @return UsageRecords
     */
    public function usageRecords();
}