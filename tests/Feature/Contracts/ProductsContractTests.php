<?php


namespace RandomState\Tests\Stripe\Feature\Contracts;


use Stripe\Product;

trait ProductsContractTests
{
    use ClientTest;

    /**
     * @test
     */
    public function can_create_product()
    {
        $product = $this->client()->create([
            'name' => 'test',
            'type' => 'service',
        ]);

        $this->assertInstanceOf(Product::class, $product);
        $this->assertEquals('test', $product->name);
        $this->assertEquals('service', $product->type);
    }

    /**
     * @test
     */
    public function can_retrieve_a_product()
    {
        $product = $this->client()->create([
            'name' => 'test',
            'type' => 'good',
        ]);

        $found = $this->client()->retrieve($product->id);

        $this->assertEquals($product->id, $found->id);
        $this->assertEquals('test', $found->name);
        $this->assertEquals('good', $found->type);
    }

    /**
     * @test
     */
    public function can_update_a_product()
    {
        $product = $this->client()->create([
            'name' => 'test',
            'type' => 'service'
        ]);

        $updated = $this->client()->update($product->id, [
            'name' => 'new test'
        ]);


        $this->assertEquals($product->id, $updated->id);
        $this->assertEquals('test', $product->name);
        $this->assertEquals('new test', $updated->name);
    }

    /**
     * @test
     */
    public function can_list_all_products()
    {
        $product = $this->client()->create([
            'name' => 'test',
            'type' => 'service'
        ]);

        $products = $this->client()->all();

        $this->assertEquals($product->id, $products->data[0]->id);
    }

    /**
     * @test
     */
    public function can_delete_a_product()
    {
        $product = $this->client()->create([
            'name' => 'test',
            'type' => 'service'
        ]);

        $deleted = $this->client()->delete($product->id);

        $this->assertEquals($product->id, $deleted->id);
        $this->assertTrue($deleted->deleted);
    }
}