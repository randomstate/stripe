<?php


namespace RandomState\Stripe\Fake;


use RandomState\Stripe\Fake\Traits\Fake;
use RandomState\Stripe\Fake\Traits\RuntimeExpansions;

class Plan extends \Stripe\Plan
{
    use RuntimeExpansions, Fake;

    public $interval_count = 1;
    public $billing_scheme = 'licensed';
}