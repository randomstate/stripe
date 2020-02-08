<?php


namespace RandomState\Stripe\Fake\Traits;


trait Updatable
{
    use ResourceClient, ResourceStorage, ExpandsResource;

    public function update($id, $params)
    {
        $resource = clone $this->retrieve($id);
        $this->resources[$id] = $resource;

        foreach($params as $key => $value) {
            $resource->{$key} = $value;
        }

        $expands = $params['expand'] ?? [];
        $this->resolveExpansions($resource, $expands);

        return $resource;
    }
}