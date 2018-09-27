<?php


namespace RandomState\Stripe\Contracts;


interface Listable
{
    public function all($params = null);
}