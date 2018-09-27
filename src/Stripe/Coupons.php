<?php


namespace RandomState\Stripe\Stripe;


use RandomState\Stripe\Stripe\Traits\CrudMethods;
use Stripe\Coupon;

class Coupons extends StripeResourceClient
{
    use CrudMethods;

    public function getResourceClass()
    {
        return Coupon::class;
    }
}