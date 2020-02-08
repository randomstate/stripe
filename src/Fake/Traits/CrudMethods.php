<?php


namespace RandomState\Stripe\Fake\Traits;



trait CrudMethods
{
    use Creatable, Retrievable, Updatable, Deletable, Listable {
        Creatable::resolveExpansions insteadof Retrievable, Updatable, Deletable, Listable;
    }
}