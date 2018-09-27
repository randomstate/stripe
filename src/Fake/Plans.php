<?php


namespace RandomState\Stripe\Fake;


use RandomState\Stripe\Fake\Traits\CrudMethods;

class Plans
{
    use CrudMethods;

    public static function idPrefix()
    {
        return 'plan_';
    }

    public function getResourceClass()
    {
        return Plan::class;
    }


}