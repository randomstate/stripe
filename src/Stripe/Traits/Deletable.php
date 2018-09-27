<?php


namespace RandomState\Stripe\Stripe\Traits;


trait Deletable
{
    public function delete($id)
    {
        return $this->retrieve($id)->delete();
    }
}