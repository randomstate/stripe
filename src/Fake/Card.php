<?php


namespace RandomState\Stripe\Fake;


class Card extends \Stripe\Card
{
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