<?php


namespace RandomState\Stripe\Stripe\Traits;


trait Updatable
{
    use Resource;

    public function update($id, $params)
    {
        return ($this->getResourceClass())::update($id, $params, $this->options());
    }
}