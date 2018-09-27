<?php

namespace RandomState\Stripe;

interface BillingProvider
{
    public function charges();

    public function customers();

    public function products();

    public function refunds();

    public function tokens();

    public function sources();

    public function coupons();

    public function plans();

    public function subscriptions();
}