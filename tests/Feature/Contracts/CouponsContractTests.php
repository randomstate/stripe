<?php


namespace RandomState\Tests\Stripe\Feature\Contracts;



use Stripe\Coupon;

trait CouponsContractTests
{
    use ClientTest;

    /**
     * @test
     */
    public function can_create_a_coupon()
    {
        $coupon = $this->client()->create([
            'percent_off' => 100.0,
            'duration' => 'once'
        ]);

        $this->assertInstanceOf(Coupon::class, $coupon);
        $this->assertEquals(100.0, $coupon->percent_off);
        $this->assertEquals('once', $coupon->duration);
    }

    /**
     * @test
     */
    public function can_retrieve_a_coupon()
    {
        $coupon = $this->client()->create([
            'percent_off' => 100.0,
            'duration' => 'once'
        ]);

        $found = $this->client()->retrieve($coupon->id);

        $this->assertEquals($coupon->id, $found->id);
    }

    /**
     * @test
     */
    public function can_update_a_coupon()
    {
        $coupon = $this->client()->create([
            'percent_off' => 20.0,
            'duration' => 'once'
        ]);

        $updated = $this->client()->update($coupon->id, [
            'metadata' => [
                'order' => '1234',
            ]
        ]);

        $this->assertEquals($coupon->id, $updated->id);
        $this->assertEquals('1234', $updated->metadata['order']);
    }

    /**
     * @test
     */
    public function can_delete_a_coupon()
    {
        $coupon = $this->client()->create([
            'percent_off' => 100.0,
            'duration' => 'once'
        ]);

        $deleted = $this->client()->delete($coupon->id);

        $this->assertEquals($coupon->id, $deleted->id);
        $this->assertTrue($deleted->deleted);
    }

    /**
     * @test
     */
    public function can_list_all_coupons()
    {
        $coupon = $this->client()->create([
            'percent_off' => 100.0,
            'duration' => 'once'
        ]);

        $coupons = $this->client()->all();

        $this->assertEquals($coupon->id, $coupons->data[0]->id);
    }
}