<?php


namespace RandomState\Stripe\Fake\Traits;


trait Ids
{
    protected function generateId()
    {
        return uniqid(static::idPrefix());
    }

    abstract public static function idPrefix();
}