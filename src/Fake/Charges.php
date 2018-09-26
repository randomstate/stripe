<?php


namespace RandomState\Stripe\Fake;


use Stripe\Collection;

class Charges
{
    protected $charges = [];

    public function create($params)
    {
        $id = $params['id'] = uniqid('ch_');
        return $this->charges[$id] = Charge::constructFrom($params);
    }

    public function retrieve($id)
    {
        return $this->charges[$id] ?? null;
    }

    public function update($id, $params)
    {
        $charge = $this->retrieve($id);
        foreach($params as $key => $value) {
            $charge->{$key} = $value;
        }

        return $charge;
    }

    public function all($params = null)
    {
        return Collection::constructFrom([
            'data' => array_values($this->charges)
        ]);
    }
}