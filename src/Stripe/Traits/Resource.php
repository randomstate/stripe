<?php


namespace RandomState\Stripe\Stripe\Traits;


trait Resource
{
    abstract public function getResourceClass();
    abstract protected function options();
}