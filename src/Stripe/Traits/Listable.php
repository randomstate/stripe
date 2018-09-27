<?php


namespace RandomState\Stripe\Stripe\Traits;


trait Listable
{
    public function all($params = null)
    {
        return ($this->getResourceClass())::all($params, $this->options());
    }
}