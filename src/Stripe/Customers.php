<?php


namespace RandomState\Stripe\Stripe;


use Stripe\Customer;

class Customers extends StripeResource
{
    public function create($params = [])
    {
        return Customer::create($params, $this->options());
    }

    public function retrieve($id)
    {
        return Customer::retrieve($id, $this->options());
    }

    public function update($id, $params)
    {
        return Customer::update($id, $params, $this->options());
    }

    public function all($params = null)
    {
        return Customer::all($params, $this->options());
    }

    public function delete($id)
    {
        return $this->retrieve($id)->delete();
    }
}