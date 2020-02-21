<?php


namespace RandomState\Stripe\Fake;


class Invoice extends \Stripe\Invoice
{
    public function &__get($k)
    {
        if($k === 'total') {
            $total = $this->total();
            return $total;
        }

        if($k === 'amount_remaining') {
            $amount = $this->amountRemaining();
            return $amount;
        }

        return parent::__get($k);
    }

    protected function total()
    {
        return array_reduce($this->lines->data, function($carry, $line) {
            return $carry + $line->amount;
        }, 0);
    }

    protected function amountRemaining()
    {
        if($this->status != 'paid') {
            return $this->total();
        }

        return 0;
    }

    public function finalizeInvoice($params = null, $opts = null)
    {
        $this->status = static::STATUS_OPEN;

        return $this;
    }

    public function pay($params = null, $opts = null)
    {
        $this->amount = 0;
        $this->status = static::STATUS_PAID;

        return $this;
    }

    public function sendInvoice($params = null, $opts = null)
    {
        return $this;
    }

    public function voidInvoice($params = null, $opts = null)
    {
        $this->status = static::STATUS_VOID;
        return $this;
    }

    public function markUncollectible($params = null, $opts = null)
    {
        $this->status = static::STATUS_UNCOLLECTIBLE;
        return $this;
    }
}