<?php


namespace RandomState\Stripe\Fake;


class Charge extends \Stripe\Charge
{
    public function capture($params = null, $options = null)
    {
        $this->captured = true;

        return $this;
    }
}