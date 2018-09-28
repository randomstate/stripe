<?php


namespace RandomState\Stripe\Stripe;


class StripeResourceClient
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