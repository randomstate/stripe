<?php


namespace RandomState\Stripe\Fake\Crud;


use RandomState\Stripe\Fake\Traits\ExpandsResource;

class Creater
{
    use ExpandsResource;

    protected $resourceClass;
    /**
     * @var array
     */
    protected $options;
    protected $generateId;

    protected $onCreate = [];

    public function __construct($generateId, $resourceClass)
    {
        $this->resourceClass = $resourceClass;
        $this->generateId = $generateId;
    }

    public function onCreate(\Closure $onCreate)
    {
        $this->onCreate[] = $onCreate;

        return $this;
    }

    public function setOnCreates(array $onCreates)
    {
        $this->onCreate = $onCreates;

        return $this;
    }

    public function create($params = [])
    {

        $id = $params['id'] ?? null;

        if(!$id) {
            $id = ($this->generateId)();
            $params['id'] = $id;
        }

        $params = array_merge([
            'created' => time(),
            'metadata' => [],
            'livemode' => false,
        ], $params);

        $expands = $params['expand'] ?? [];
        unset($params['expand']);

        $object = ($this->resourceClass)::constructFrom($params);

        $this->resolveExpansions($object, $expands);

        foreach($this->onCreate as $callback) {
            $callback($object);
        }

        return $object;
    }
}