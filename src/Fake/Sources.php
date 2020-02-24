<?php


namespace RandomState\Stripe\Fake;


use RandomState\Stripe\Fake\Traits\CruMethods;

class Sources extends FakeClient implements \RandomState\Stripe\Contracts\Sources
{
    // Only uses lists in Fake to access elements for customers' nested sources.
    use CruMethods;

    public function create($params = [])
    {
        if($params['source'] ?? false) {
            $source = $this->generateTestSource($params);
            return $this->resources[$source->id] = $source;
        }

        $id = $params['id'] ?? null;

        if(!$id) {
            $id = $this->generateId();
            $params['id'] = $id;
        }

        $params['metadata'] = [];

        return $this->resources[$id] = ($this->getResourceClass())::constructFrom($params);
    }

    public function getResourceClass()
    {
        return Source::class;
    }

    public static function idPrefix()
    {
        return 'src_';
    }

    private function generateTestSource(array $params)
    {
        // if dummy card given, return a card object that matches it
        // if direct source id given and is a card, return a card object that matches it to the best possible
        return (new DummySourceFactory($this->stripe))->build($params);
    }
}