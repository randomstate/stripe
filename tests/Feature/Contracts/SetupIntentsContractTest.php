<?php


namespace RandomState\Tests\Stripe\Feature\Contracts;


use RandomState\Stripe\Contracts\SetupIntents;
use Stripe\SetupIntent;

trait SetupIntentsContractTest
{
    use ClientTest;

    /**
     * @return SetupIntents
     */
    abstract public function createClient();

    /**
     * @test
     */
    public function can_create_setup_intent()
    {
        $intent = $this->client()->create();
        $this->assertInstanceOf(SetupIntent::class, $intent);
    }

    /**
     * @test
     */
    public function can_retrieve_setup_intent()
    {
        $intent = $this->client()->create();
        $found = $this->client()->retrieve($intent->id);

        $this->assertEquals($intent->id, $found->id);
    }

    /**
     * @test
     */
    public function can_update_setup_intent()
    {
        $intent = $this->client()->create();
        $updated = $this->client()->update($intent->id, [
            'payment_method_types' => ['card'],
        ]);

        $this->assertEquals($intent->id, $updated->id);
        $this->assertEquals('card', $updated->payment_method_types[0]);
    }

    /**
     * @test
     */
    public function can_confirm_setup_intent_with_payment_method()
    {
        $intent = $this->client()->create([
            'payment_method_types' => ['card'],
        ]);

        $intent->confirm([
            'payment_method' => 'pm_card_visa',
        ]);

        $this->assertEquals('succeeded', $intent->status);
    }

    /**
     * @test
     */
    public function can_cancel_setup_intent()
    {
        $intent = $this->client()->create([
            'payment_method_types' => ['card'],
        ]);

        $intent->cancel();

        $this->assertEquals('canceled', $intent->status);
    }

    /**
     * @test
     */
    public function can_list_setup_intents()
    {
        $intent = $this->client()->create([
            'payment_method_types' => ['card'],
        ]);

        $intents = $this->client()->all();

        $this->assertEquals($intent->id, $intents->data[0]->id);
    }
}