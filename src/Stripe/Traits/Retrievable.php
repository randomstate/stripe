<?php


namespace RandomState\Stripe\Stripe\Traits;


trait Retrievable
{
    use ResourceClient;

    public function retrieve($id)
    {
        return ($this->getResourceClass())::retrieve($id, $this->options());
    }
}