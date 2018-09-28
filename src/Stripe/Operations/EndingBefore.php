<?php


namespace RandomState\Stripe\Stripe\Operations;


class EndingBefore
{
    public function apply($items, $opts = null)
    {
        // get in reverse chronological
        // find array index of id
        $items = array_values($items);
        $foundKey = null;

        foreach($items as $key => $item) {
            if($item->id == $opts) {
                $foundKey = $key;
            }
        }

        if(!$foundKey) {
            throw new \Exception("Resource with id {$opts} does not exist.");
        }

        // get everything newer than that (head of the array)
        return array_splice($items, 0, $foundKey);
    }
}