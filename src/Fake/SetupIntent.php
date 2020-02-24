<?php


namespace RandomState\Stripe\Fake;


use RandomState\Stripe\Fake\Traits\Fake;
use RandomState\Stripe\Fake\Traits\RuntimeExpansions;

class SetupIntent extends \Stripe\SetupIntent
{
    use RuntimeExpansions, Fake;

    public function confirm($params = null, $options = null)
    {
        $this->updateAttributes($params);

        if($this->payment_method) {
            $this->status = 'succeeded';

            return $this;
        }

        $this->status = 'requires_payment_method';
        return $this;
    }

    public function cancel($params = null, $options = null)
    {
        $this->status = 'canceled';

        return $this;
    }
}