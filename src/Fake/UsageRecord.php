<?php


namespace RandomState\Stripe\Fake;


use RandomState\Stripe\Fake\Traits\Fake;
use RandomState\Stripe\Fake\Traits\RuntimeExpansions;

class UsageRecord extends \Stripe\UsageRecord
{
    use RuntimeExpansions, Fake;
}