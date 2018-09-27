<?php


namespace RandomState\Tests\Stripe\Feature\Contracts;


use Stripe\Plan;

trait PlansContractTests
{
    use ClientTest;

    protected $products;

    public function products()
    {
        if (!$this->products) {
            $this->products = $this->createProductsClient();
        }

        return $this->products;
    }

    abstract public function createProductsClient();

    /**
     * @test
     */
    public function can_create_a_plan()
    {
        $product = $this->products()->create([
            'name' => 'test product',
            'type' => 'service',
        ]);

        $plan = $this->client()->create([
            'product' => $product->id,
            'currency' => 'gbp',
            'interval' => 'month',
            'amount' => 10000,
        ]);

        $this->assertInstanceOf(Plan::class, $plan);
        $this->assertEquals($product->id, $plan->product);
        $this->assertEquals('gbp', $plan->currency);
        $this->assertEquals('month', $plan->interval);
        $this->assertEquals(10000, $plan->amount);
    }

    /**
     * @test
     */
    public function can_retrieve_a_plan()
    {
        $product = $this->products()->create([
            'name' => 'test product',
            'type' => 'service',
        ]);

        $plan = $this->client()->create([
            'product' => $product->id,
            'currency' => 'gbp',
            'interval' => 'month',
            'amount' => 10000,
        ]);

        $found = $this->client()->retrieve($plan->id);
        $this->assertEquals($plan->id, $found->id);
    }

    /**
     * @test
     */
    public function can_update_a_plan()
    {
        $product = $this->products()->create([
            'name' => 'test product',
            'type' => 'service',
        ]);

        $plan = $this->client()->create([
            'product' => $product->id,
            'currency' => 'gbp',
            'interval' => 'month',
            'amount' => 10000,
        ]);

        $updated = $this->client()->update($plan->id, [
            'active' => false,
        ]);

        $this->assertEquals($plan->id, $updated->id);
        $this->assertFalse($updated->active);
    }

    /**
     * @test
     */
    public function can_delete_a_plan()
    {
        $product = $this->products()->create([
            'name' => 'test product',
            'type' => 'service',
        ]);

        $plan = $this->client()->create([
            'product' => $product->id,
            'currency' => 'gbp',
            'interval' => 'month',
            'amount' => 10000,
        ]);

        $deleted = $this->client()->delete($plan->id);

        $this->assertEquals($plan->id, $deleted->id);
        $this->assertTrue($deleted->deleted);
    }

    /**
     * @test
     */
    public function can_list_all_plans()
    {
        $product = $this->products()->create([
            'name' => 'test product',
            'type' => 'service',
        ]);

        $plan = $this->client()->create([
            'product' => $product->id,
            'currency' => 'gbp',
            'interval' => 'month',
            'amount' => 10000,
        ]);

        $plans = $this->client()->all();
        $this->assertEquals($plan->id, $plans->data[0]->id);
    }
}