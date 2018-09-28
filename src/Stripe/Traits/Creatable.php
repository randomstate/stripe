<?php


namespace RandomState\Stripe\Stripe\Traits;


trait Creatable
{
    use ResourceClient;

    public function create($params = [])
    {
        return ($this->getResourceClass())::create($params, $this->options());
    }
}