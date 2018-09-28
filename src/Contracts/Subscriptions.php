<?php


namespace RandomState\Stripe\Contracts;


interface Subscriptions extends Creatable, Retrievable, Updatable, Listable
{
    public function items();
}