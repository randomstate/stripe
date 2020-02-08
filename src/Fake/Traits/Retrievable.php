<?php


namespace RandomState\Stripe\Fake\Traits;


trait Retrievable
{
    use ExpandsResource;

    public function retrieve($params)
    {
        $id = $params['id'] ?? $params;

        $item = $this->resources[$id] ?? null;

        $expands = $params['expand'] ?? [];
        $this->resolveExpansions($item, $expands);

        if(!$item) {
            return null;
        }

        return clone $item;
    }
}