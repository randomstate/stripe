<?php


namespace RandomState\Stripe\Stripe\Operations;


class TypeFilter
{
    public function apply($items, $opts = null)
    {
        return array_filter($items, function($item) use($opts) {
            return $item->type === $opts;
        });
    }
}