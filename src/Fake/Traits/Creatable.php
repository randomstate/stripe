<?php


namespace RandomState\Stripe\Fake\Traits;


trait Creatable
{
    use ResourceClient, ResourceStorage;

    public function create($params = [])
    {
        $id = $this->generateId();
        $params['id'] = $id;
        return $this->resources[$id] = ($this->getResourceClass())::constructFrom($params);
    }

    public function retrieve($id)
    {
        return $this->resources[$id] ?? null;
    }

    protected function generateId()
    {
        return uniqid(static::idPrefix());
    }

    abstract public static function idPrefix();
}