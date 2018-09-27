<?php


namespace RandomState\Stripe\Fake\Traits;


trait Updatable
{
    use ResourceClient, ResourceStorage;

    public function update($id, $params)
    {
        $resource = $this->retrieve($id);
        foreach($params as $key => $value) {
            $resource->{$key} = $value;
        }

        return $resource;
    }
}