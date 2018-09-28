<?php


namespace RandomState\Stripe\Contracts;


interface Creatable
{
    public function create($params = []);
}