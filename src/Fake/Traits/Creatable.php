<?php


namespace RandomState\Stripe\Fake\Traits;


trait Creatable
{
    use ResourceClient, ResourceStorage, Ids, ExpandsResource;

    protected $onCreate = [];

    public function create($params = [])
    {
        $creater = new \RandomState\Stripe\Fake\Crud\Creater(function() {
            return $this->generateId();
        }, $this->getResourceClass());
        
        foreach($this->onCreate as $onCreate) {
            $creater->onCreate($onCreate);
        }
        
        $object = $creater
            ->create($params);

        $this->resources[$object->id] = $object;

        return $object;
    }
}