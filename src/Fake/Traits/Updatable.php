<?php


namespace RandomState\Stripe\Fake\Traits;


trait Updatable
{
    use ResourceClient, ResourceStorage;

    public function update($id, $params)
    {
        $resource = clone $this->retrieve($id);
        $this->resources[$id] = $resource;

        foreach($params as $key => $value) {
            $resource->{$key} = $value;
        }

        return $resource;
    }
}