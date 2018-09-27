<?php


namespace RandomState\Stripe\Fake;


use Stripe\Collection;
use Stripe\Customer;

class Customers
{
    /**
     * @var Customer
     */
    protected $customers = [];

    public function create($params = [])
    {
        $id = uniqid('cust_');
        $params['id'] = $id;

        return $this->customers[$id] = Customer::constructFrom($params);
    }

    public function retrieve($id)
    {
        return $this->customers[$id] ?? null;
    }

    public function update($id, $params)
    {
        $customer = $this->retrieve($id);
        foreach($params as $key => $value) {
            $customer->{$key} = $value;
        }

        return $customer;
    }

    public function delete($id)
    {
        $customer = $this->retrieve($id);
        $customer->deleted = true;

        return $customer;
    }

    public function all($params = [])
    {
        return Collection::constructFrom(['data' => array_values($this->customers)]);
    }
}