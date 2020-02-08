<?php


namespace RandomState\Stripe\Fake;


use RandomState\Stripe\Fake\Traits\RuntimeExpansions;

class Coupon extends \Stripe\Coupon
{
    use RuntimeExpansions;
}