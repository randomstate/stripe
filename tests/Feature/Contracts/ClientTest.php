<?php


namespace RandomState\Tests\Stripe\Feature\Contracts;


trait ClientTest
{
    protected $client;

    protected function setUp()
    {
        parent::setUp();
        $this->client = $this->createClient();
    }

    public function client()
    {
        return $this->client;
    }

    abstract public function createClient();
}