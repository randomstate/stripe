<?php


namespace RandomState\Stripe\Fake\Traits;


trait Creatable
{
    use ResourceClient, ResourceStorage, Ids;

    public function create($params = [])
    {
        $id = $params['id'] ?? null;

        if(!$id) {
            $id = $this->generateId();
            $params['id'] = $id;
        }
        
        $params['metadata'] = [];

        return $this->resources[$id] = ($this->getResourceClass())::constructFrom($params);
    }
}