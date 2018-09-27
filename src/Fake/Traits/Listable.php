<?php


namespace RandomState\Stripe\Fake\Traits;


use RandomState\Stripe\Fake\Nested\RequestableCollection;
use Stripe\Collection;

trait Listable
{
    use ResourceClient, ResourceStorage;

    public function all($params = null)
    {
        return RequestableCollection::constructFrom([
            'data' => array_values($this->resources)
        ]);
    }
}