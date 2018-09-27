<?php


namespace RandomState\Stripe\Fake\Traits;


trait Deletable
{
    public function delete($id)
    {
        $resource = $this->retrieve($id);
        $resource->deleted = true;

        return $resource;
    }
}