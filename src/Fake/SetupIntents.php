<?php


namespace RandomState\Stripe\Fake;


use RandomState\Stripe\Fake\Traits\CrudMethods;

class SetupIntents extends FakeClient implements \RandomState\Stripe\Contracts\SetupIntents
{
    use CrudMethods;

    public function getResourceClass()
    {
        return SetupIntent::class;
    }

    public static function idPrefix()
    {
        return "seti_";
    }
}