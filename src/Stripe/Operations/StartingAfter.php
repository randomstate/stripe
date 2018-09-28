<?php


namespace RandomState\Stripe\Stripe\Operations;


class StartingAfter
{
    public function apply($items, $opts = null)
    {
        // get in chronological order
        $items = array_values($items);

        usort($items, function($a, $b) {
            if($a->created == $b->created){
                return 0;
            }

            return ($a->created < $b->created) ? -1 : 1;
        });


        // find array index of id
        $items = array_values($items);
        $foundKey = null;

        foreach($items as $key => $item) {
            if($item->id == $opts) {
                $foundKey = $key;
                break;
            }
        }

        if(is_null($foundKey)) {
            throw new \Exception("Resource with id {$opts} does not exist.");
        }

        // get everything older than that (end of the array)
        $remaining = array_splice($items, $foundKey + 1, count($items) - ($foundKey + 1));
        return $remaining;
    }
}