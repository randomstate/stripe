<?php


namespace RandomState\Stripe\Fake;


class SetupIntent extends \Stripe\SetupIntent
{
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