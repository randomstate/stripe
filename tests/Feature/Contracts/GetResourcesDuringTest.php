<?php


namespace RandomState\Tests\Stripe\Feature\Contracts;


trait GetResourcesDuringTest
{
    use ClientTest;

    /**
     * @test
     */
    public function can_get_resources_created_during_a_closure()
    {
        $created = [];
        // Use charges as example for all Listables
        $charges = $this->client()->during(function() use(&$created) {
            $charges[] = $this->client()->create([
                'amount' => 100,
                'currency' => 'gbp',
                'source' => 'tok_visa_debit',
            ]);

            $charges[] = $charge = $this->client()->create([
                'amount' => 200,
                'currency' => 'usd',
                'source' => 'tok_visa',
            ]);
        });

        $this->assertCount(2, $charges);
    }
}