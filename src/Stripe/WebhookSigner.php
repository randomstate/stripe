<?php


namespace RandomState\Stripe\Stripe;


use Closure;
use Stripe\Event;

class WebhookSigner
{
    /**
     * @var Closure
     */
    protected $time;

    /**
     * @var string
     */
    protected $key;

    public function __construct($signingKey, Closure $timestampResolver = null)
    {
        $this->key = $signingKey;
        $this->time = $timestampResolver ?? function() { return time(); };
    }

    public function sign(Event $event)
    {
        return $this->signRaw(json_encode($event->jsonSerialize()));
    }

    public function signRaw(string $data)
    {
        // get the current time

        // concatenate timestamp, '.', json payload

        // hmac sha256 with key
        $time = ($this->time)();

        $toSign = "$time.$data";
        $signature = hash_hmac('sha256', $toSign, $this->key);

        return "t=$time,v1=$signature";
    }
}