<?php


namespace RandomState\Stripe\Stripe\Operations;


class ReverseChronologicalOrder
{
    public function apply($items, $opts = null)
    {
        $sorted = array_values($items);

        usort($sorted, function($a, $b) {
            if($a->created == $b->created){
                return 0;
            }

            return ($a->created > $b->created) ? -1 : 1;
        });

        return $sorted;
    }
}