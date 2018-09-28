<?php


namespace RandomState\Stripe\Stripe\Operations;


class LimitOperator
{
    public function apply($items, $opts = null)
    {
        $items = array_values($items);
        return array_splice($items,0, $opts );
    }
}