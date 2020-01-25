<?php


namespace RandomState\Stripe\Stripe\Operations;


class CustomerFilter
{
    public function apply($items, $opts = null)
    {
        return array_filter($items, function($item) use($opts) {
            return $item->customer === $opts;
        });
    }
}