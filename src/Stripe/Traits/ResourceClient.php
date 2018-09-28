<?php


namespace RandomState\Stripe\Stripe\Traits;


trait ResourceClient
{
    abstract public function getResourceClass();
    abstract protected function options();
}