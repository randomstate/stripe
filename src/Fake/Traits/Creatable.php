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

        $params = array_merge([
            'created' => time(),
            'metadata' => [],
            'livemode' => false,
        ], $params);

        return $this->resources[$id] = ($this->getResourceClass())::constructFrom($params);
    }
}