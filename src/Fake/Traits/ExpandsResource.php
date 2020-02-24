<?php


namespace RandomState\Stripe\Fake\Traits;


trait ExpandsResource
{

    protected function resolveExpansions($object, array $expands = [])
    {
        // for each expand, split on delimiter
        // for each part, resolve from previous object until no longer any parts remaining
        // each part should be set on the previous object
        foreach($expands as $expand) {
            $current = $object;
            $parts = explode('.', $expand);

            foreach($parts as $part) {
                $words = str_replace('_', ' ', $part);
                $methodName = 'expand' . str_replace(' ', '', ucwords($words));

                $current->{$part} = $current->{$methodName}();
                $current = $current->{$part};
            }
        }

        return $object;
    }
}