<?php


namespace RandomState\Stripe\Fake\Traits;


use RandomState\Stripe\Fake\Crud\Updater;

trait Updatable
{
    use ResourceClient, ResourceStorage, ExpandsResource;

    protected $onUpdate = [];

    public function update($id, $params)
    {
        $resource = clone $this->retrieve($id);
        $this->resources[$id] = $resource;

        (new Updater)
            ->setOnUpdates($this->onUpdate)
            ->update($resource, $params);

        return $resource;
    }
}