<?php


namespace RandomState\Stripe\Fake;


use RandomState\Stripe\Fake\Traits\RuntimeExpansions;

class PaymentMethod extends \Stripe\PaymentMethod
{
    use RuntimeExpansions;

    public function attach($params = null, $opts = null)
    {
        $customer = $params['customer'] ?? null;

        $this->customer = $customer;

        return $this;
    }

    public function detach($params = null, $opts = null)
    {
        $this->customer = null;

        return $this;
    }
}