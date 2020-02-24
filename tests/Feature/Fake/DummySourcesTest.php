<?php


namespace RandomState\Tests\Stripe\Feature\Fake;


use RandomState\Stripe\Fake\Card;
use RandomState\Stripe\Fake\DummySourceFactory;
use RandomState\Stripe\Fake\Source;
use RandomState\Tests\Stripe\TestCase;

class DummySourcesTest extends TestCase
{
    /**
     * @var DummySourceFactory
     */
    protected $factory;

    protected function setUp()
    {
        parent::setUp();
        $this->factory = new DummySourceFactory($this->fake);
    }

    /**
     * @test
     */
    public function can_generate_card_object_from_numbers()
    {
        foreach(DummySourceFactory::$cardNumbers as $number => $token) {
            $card = $this->factory->build([
                'source' => [
                    'type' => 'card',
                    'number' => $number,
                    'exp_month' => 9,
                    'exp_year' => 2018,
                    'cvc' => 133,
                ]
            ]);

            $this->assertInstanceOf(Card::class,$card);
            $this->assertEquals(substr($number, -4, 4), $card->last4);
        }
    }

    /**
     * @test
     */
    public function can_generate_card_object_from_known_card_test_tokens()
    {
        foreach(DummySourceFactory::$cardNumbers as $number => $cardToken) {
            $card = $this->factory->build([
                'source' => $cardToken
            ]);

            $this->assertInstanceOf(Card::class,$card);
        }
    }

    /**
     * @test
     */
    public function generates_empty_source_with_id_as_best_alternative_when_not_known_card() 
    {
        $source = $this->factory->build([
            'source' => 'random_id_provided',
        ]);

        $this->assertInstanceOf(Source::class, $source);
    }
}