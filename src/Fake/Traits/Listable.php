<?php


namespace RandomState\Stripe\Fake\Traits;


use Stripe\Collection;

trait Listable
{
    use ResourceClient, ResourceStorage;

    public function all($params = null)
    {
        return Collection::constructFrom([
            'data' => array_values($this->resources)
        ]);
    }
}