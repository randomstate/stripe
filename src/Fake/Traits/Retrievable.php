<?php


namespace RandomState\Stripe\Fake\Traits;


trait Retrievable
{
    public function retrieve($id)
    {
        $item = $this->resources[$id] ?? null;

        if(!$item) {
            return null;
        }

        return clone $item;
    }
}