<?php


namespace RandomState\Stripe\Stripe\Traits;


trait Listable
{
    use ResourceClient;

    public function all($params = null)
    {
        return ($this->getResourceClass())::all($params, $this->options());
    }
}