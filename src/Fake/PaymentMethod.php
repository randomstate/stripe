<?php


namespace RandomState\Stripe\Fake;


class PaymentMethod extends \Stripe\PaymentMethod
{
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