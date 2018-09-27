<?php


namespace RandomState\Stripe\Fake;


use RandomState\Stripe\Fake\Traits\CrudMethods;

class Coupons implements \RandomState\Stripe\Contracts\Coupons
{
    use CrudMethods;

    public static function idPrefix()
    {
        return 'cpn_'; // irrelevant for coupons really
    }

    public function getResourceClass()
    {
        return Coupon::class;
    }


}