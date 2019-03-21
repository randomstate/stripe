<?php


namespace RandomState\Tests\Stripe\Feature\Stripe;


use RandomState\Stripe\Stripe\WebhookSigner;
use RandomState\Tests\Stripe\TestCase;
use Stripe\Webhook;

class WebhookSignerTest extends TestCase
{
    /** @var WebhookSigner */
    protected $signer;

    /** @var int */
    protected $timestamp;

    protected $testPayload;

    protected function setUp()
    {
        parent::setUp();
        $this->signer = new WebhookSigner('test_key',
            function(){
            return $this->timestamp = (new \DateTime)->getTimestamp();
        });

        $this->testPayload = require(__DIR__. '/customer.subscription.created.php');
    }

    /**
     * @test
     */
    public function can_sign_payloads()
    {
        $signature = $this->signer->signRaw($this->testPayload);
        $valid = false;

        try {
            Webhook::constructEvent($this->testPayload, $signature, 'test_key'); // throws error if not valid
            $valid = true;
        } catch(\Exception $e) {
            $this->fail('Generated signature was not found to be valid');
        }

        $this->assertTrue($valid);
    }
}