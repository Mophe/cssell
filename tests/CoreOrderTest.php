<?php

include __DIR__ . '/autoloadClass.php';

/**
 * Generated by PHPUnit_SkeletonGenerator on 2014-12-13 at 14:00:56.
 */
class CoreOrderTest extends PHPUnit_Framework_TestCase {

    /**
     * @var CoreOrder
     */
    protected $object;

    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp() {
        $this->object = new CoreOrder;
    }

    /**
     * Tears down the fixture, for example, closes a network connection.
     * This method is called after a test is executed.
     */
    protected function tearDown() {

    }

    /**
     * Generated from @assert ('a', '13000000000',array(array('name'=>'辣条','price'=>0.5,'number'=>1)), 'haha') == true.
     *
     * @covers CoreOrder::addOrder
     */
    public function testAddOrder() {
        $this->assertEquals(
                true
                , $this->object->addOrder('a', '13000000000', array(array('name' => '辣条', 'price' => 0.5, 'number' => 1)), 'haha')
        );
    }

    /**
     * Generated from @assert ('2014-12-10 00:00:00', '2014-12-20 00:00:00') == 0.5.
     *
     * @covers CoreOrder::countMoney
     */
    public function testCountMoney() {
        $this->assertEquals(
                0.5
                , $this->object->countMoney('2014-12-10 00:00:00', '2014-12-20 00:00:00')
        );
    }

    /**
     * Generated from @assert ('a', Order::first(array('conditions'=>array('name'=>'a')))->time) == true.
     *
     * @covers CoreOrder::deleteOrder
     */
    public function testDeleteOrder() {
        $this->assertEquals(
                true
                , $this->object->deleteOrder('a', Order::first(array('conditions' => array('name' => 'a')))->time)
        );
    }

    /**
     * Generated from @assert ('b', '2014-12-12 00:00:00') == false.
     *
     * @covers CoreOrder::deleteOrder
     */
    public function testDeleteOrder2() {
        $this->assertEquals(
                false
                , $this->object->deleteOrder('b', '2014-12-12 00:00:00')
        );
    }

}