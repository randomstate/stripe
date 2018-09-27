<?php


namespace RandomState\Stripe\Stripe\Traits;


trait Creatable
{
    use Resource;

    public function create($params = [])
    {
        return ($this->getResourceClass())::create($params, $this->options());
    }

    // Everything is always readable if creatable
    public function retrieve($id)
    {
        return ($this->getResourceClass())::retrieve($id, $this->options());
    }
}