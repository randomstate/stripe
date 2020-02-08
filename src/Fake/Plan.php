<?php


namespace RandomState\Stripe\Fake;


use RandomState\Stripe\Fake\Traits\RuntimeExpansions;

class Plan extends \Stripe\Plan
{
    use RuntimeExpansions;
}