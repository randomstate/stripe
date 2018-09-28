<?php


namespace RandomState\Stripe\Stripe\Traits;


trait Updatable
{
    use ResourceClient;

    public function update($id, $params)
    {
        return ($this->getResourceClass())::update($id, $params, $this->options());
    }
}