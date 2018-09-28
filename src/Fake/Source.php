<?php


namespace RandomState\Stripe\Fake;


class Source extends \Stripe\Source
{
    public function save($opts = null)
    {
        return $this;
    }

    public function detach($params = null, $options = null)
    {
        $this->status = 'consumed';

        return $this;
    }

    public function delete($params = null, $options = null)
    {
        $this->status = 'consumed';
        $this->deleted = true;

        return $this;
    }
}