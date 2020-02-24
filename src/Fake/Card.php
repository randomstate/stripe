<?php


namespace RandomState\Stripe\Fake;


use RandomState\Stripe\Fake\Traits\Fake;
use RandomState\Stripe\Fake\Traits\RuntimeExpansions;

class Card extends \Stripe\Card
{
    use RuntimeExpansions, Fake;
    
    public function save($opts = null)
    {
    }

    public function delete($params = null, $opts = null)
    {
        $this->status = 'consumed';
        $this->deleted = true;

        return $this;
    }
}