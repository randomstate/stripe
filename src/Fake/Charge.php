<?php


namespace RandomState\Stripe\Fake;


use RandomState\Stripe\Fake\Traits\Fake;
use RandomState\Stripe\Fake\Traits\RuntimeExpansions;

class Charge extends \Stripe\Charge
{
    use RuntimeExpansions, Fake;

    public function capture($params = null, $options = null)
    {
        $this->captured = true;

        return $this;
    }
}