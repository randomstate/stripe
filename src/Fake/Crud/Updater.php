<?php


namespace RandomState\Stripe\Fake\Crud;


use RandomState\Stripe\Fake\Traits\ExpandsResource;

class Updater
{
    use ExpandsResource;

    protected $onUpdate = [];

    public function __construct()
    {
    }

    public function setOnUpdates(array $onUpdates)
    {
        $this->onUpdate = $onUpdates;

        return $this;
    }

    public function update($resource, $params = [])
    {
        foreach($params as $key => $value) {
            if($key === 'id') {
                continue;
            }

            $resource->{$key} = $value;
        }

        foreach($this->onUpdate as $onUpdate) {
            $onUpdate($resource);
        }

        $expands = $params['expand'] ?? [];
        $this->resolveExpansions($resource, $expands);

        return $resource;
    }
}