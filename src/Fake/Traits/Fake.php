<?php


namespace RandomState\Stripe\Fake\Traits;


use RandomState\Stripe\BillingProvider;

trait Fake
{
    /** @var BillingProvider */
    public $fake;

    public function refresh()
    {
        return $this;
    }
}