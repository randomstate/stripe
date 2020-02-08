<?php


namespace RandomState\Stripe\Fake;


use RandomState\Stripe\Fake\Traits\RuntimeExpansions;

class Refund extends \Stripe\Refund
{
    use RuntimeExpansions;
}