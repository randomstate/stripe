<?php


namespace RandomState\Stripe\Stripe\Traits;


use Closure;

trait Listable
{
    use ResourceClient;

    public function all($params = null)
    {
        return ($this->getResourceClass())::all($params, $this->options());
    }

    public function during(Closure $closure)
    {
        $id = $this->mostRecentId();

        $closure();

        return $this->all([
            'ending_before' => $id,
            'limit' => 100,
        ])->autoPagingIterator();
    }

    public function mostRecentId()
    {
        $resources = $this->all([
            'limit' => 1,
        ]);

        if (count($resources->data) > 0) {
            return array_values($resources->data)[0]->id;
        }

        return null;
    }
}