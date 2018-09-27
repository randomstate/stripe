<?php


namespace RandomState\Stripe\Stripe;


use Stripe\Charge;

class Charges extends StripeResource
{
    public function create($params)
    {
        return Charge::create($params, $this->options());
    }

    public function retrieve($id)
    {
        return Charge::retrieve($id, $this->options());
    }

    public function update($id, $params)
    {
        return Charge::update($id, $params, $this->options());
    }

    public function all($params = null)
    {
        return Charge::all($params, $this->options());
    }
}