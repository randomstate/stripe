<?php


namespace RandomState\Stripe\Fake\Traits;


use Closure;
use RandomState\Stripe\Fake\Nested\RequestableCollection;

trait Listable
{
    use ResourceClient, ResourceStorage;

    public function all($params = null)
    {
        return RequestableCollection::constructFrom([
            'data' => array_values($this->inReverseChronologicalOrder($this->resources))
        ]);
    }

    public function during(Closure $closure)
    {
        $id = $this->mostRecentId();
        $closure();

        return $this->all([
            'ending_before' => $id,
            'limit' => 100,
        ]);
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

    // To comply with the way stripe orders resources
    protected function inReverseChronologicalOrder($resources)
    {
        $sorted = array_values($resources);

        usort($sorted, function($a, $b) {
            if($a->created == $b->created){
                return 0;
            }

            return ($a->created < $b->created) ? -1 : 1;
        });

        return $sorted;
    }
}