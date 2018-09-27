<?php


namespace RandomState\Stripe\Contracts;


interface Updatable
{
    public function update($id, $params);
}