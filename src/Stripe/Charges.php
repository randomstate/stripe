<?php


namespace RandomState\Stripe\Stripe;


use Stripe\Charge;

class Charges
{
    protected $apiKey;

    public function __construct($apiKey)
    {
        $this->apiKey = $apiKey;
    }

    public function create($params)
    {
        return Charge::create($params, $this->options());
    }

    public function retrieve($id)
    {
        return Charge::retrieve($id, $this->options());
    }

    protected function options()
    {
        return [
            'api_key' => $this->apiKey
        ];
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