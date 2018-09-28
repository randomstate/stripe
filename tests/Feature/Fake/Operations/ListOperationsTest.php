<?php


namespace RandomState\Tests\Stripe\Feature\Fake\Operations;


use RandomState\Stripe\Stripe\Operations\ListOperator;
use RandomState\Tests\Stripe\TestCase;

class ListOperationsTest extends TestCase
{
    /**
     * @var ListOperator
     */
    protected $operator;
    protected $items;

    protected function setUp()
    {
        parent::setUp();

        $this->operator = new ListOperator();
        $this->items =  [
            (object) [
                'id' => '1234',
                'created' => 1313794800, // 2011
            ],
            (object) [
                'id' => '2345',
                'created' => 1388620800, // 2014
            ],
            (object) [
                'id' => '3456',
                'created' => 1493420400, // 2017
            ]
        ];
    }

    /**
     * @test
     */
    public function list_in_reverse_chronological_order()
    {
        $applied = $this->operator->apply([], $this->items);

        $this->assertEquals('3456', $applied[0]->id);
        $this->assertCount(3, $applied);
    }

    /**
     * @test
     */
    public function can_limit_list() 
    {
        $applied = $this->operator->apply(['limit' => 1], $this->items);

        $this->assertEquals('3456', $applied[0]->id); // will be in reverse chronological order
        $this->assertCount(1, $applied);
    }
    
    /**
     * @test
     */
    public function can_specify_ending_before() 
    {
       $applied = $this->operator->apply(['ending_before' => '2345'], $this->items);

       $this->assertCount(1, $applied);
       $this->assertEquals('3456', $applied[0]->id);
    }
    
    /**
     * @test
     */
    public function can_specify_starting_after() 
    {
        // now in chronological order after the object id at hand
        $applied = $this->operator->apply(['starting_after' => '1234'], $this->items);

        $this->assertCount(2, $applied);
        $this->assertEquals('2345', $applied[0]->id);
        $this->assertEquals('3456', $applied[1]->id);
    }

}