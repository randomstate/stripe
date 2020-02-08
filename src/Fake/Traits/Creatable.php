<?php


namespace RandomState\Stripe\Fake\Traits;


trait Creatable
{
    use ResourceClient, ResourceStorage, Ids, ExpandsResource;

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

        $expands = $params['expand'] ?? [];
        unset($params['expand']);

        $this->resources[$id] = $object = ($this->getResourceClass())::constructFrom($params);

        $this->resolveExpansions($object, $expands);

        return $object;
    }
}