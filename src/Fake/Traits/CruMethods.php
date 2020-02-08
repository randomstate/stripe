<?php


namespace RandomState\Stripe\Fake\Traits;


trait CruMethods
{
    use Creatable, Retrievable, Updatable, Listable {
        Creatable::resolveExpansions insteadof Retrievable, Updatable, Listable;
    }
}