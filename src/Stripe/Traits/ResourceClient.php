<?php


namespace RandomState\Stripe;


trait ResourceClient
{
    abstract public function getResourceClass();
    abstract protected function options();
}