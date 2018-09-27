<?php


namespace RandomState\Stripe\Stripe;


class StripeResource
{
    /**
     * @var string
     */
    protected $apiKey;

    public function __construct($apiKey)
    {
        $this->apiKey = $apiKey;
    }

    protected function options()
    {
        return [
            'api_key' => $this->apiKey,
        ];
    }
}