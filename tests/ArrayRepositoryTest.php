<?php

use Mockery as m;

class ArrayRepositoryTest extends PHPUnit_Framework_TestCase
{
    public function tearDown()
    {
        m::close();
    }

    public function testSetShouldSetGivenValue()
    {
        $repository = new \Krucas\Counter\ArrayRepository();
        $this->assertNull($repository->get('test'));
        $repository->set('test', 8);
        $this->assertEquals(8, $repository->get('test'));
    }

    public function testSetShouldOverrideGivenValue()
    {
        $repository = new \Krucas\Counter\ArrayRepository();
        $repository->set('test', 5);
        $this->assertEquals(5, $repository->get('test'));
        $repository->set('test', 8);
        $this->assertEquals(8, $repository->get('test'));
    }

    public function testSetForShouldSetGivenValue()
    {
        $date = new DateTime();
        $repository = new \Krucas\Counter\ArrayRepository();
        $this->assertNull($repository->getFor('test', $date));
        $repository->setFor('test', $date, 8);
        $this->assertEquals(8, $repository->getFor('test', $date));
    }

    public function testSetForShouldOverrideGivenValue()
    {
        $date = new DateTime();
        $repository = new \Krucas\Counter\ArrayRepository();
        $repository->setFor('test', $date, 5);
        $this->assertEquals(5, $repository->getFor('test', $date));
        $repository->setFor('test', $date, 8);
        $this->assertEquals(8, $repository->getFor('test', $date));
    }

    public function testSetForRangeShouldSetGivenValue()
    {
        $start = new DateTime();
        $end = new DateTime();
        $end->add(new DateInterval('P2Y4DT6H8M'));
        $repository = new \Krucas\Counter\ArrayRepository();
        $this->assertNull($repository->getForRange('test', $start, $end));
        $repository->setForRange('test', $start, $end, 8);
        $this->assertEquals(8, $repository->getForRange('test', $start, $end));
    }

    public function testSetForRangeShouldOverrideGivenValue()
    {
        $start = new DateTime();
        $end = new DateTime();
        $end->add(new DateInterval('P2Y4DT6H8M'));
        $repository = new \Krucas\Counter\ArrayRepository();
        $repository->setForRange('test', $start, $end, 5);
        $this->assertEquals(5, $repository->getForRange('test', $start, $end));
        $repository->setForRange('test', $start, $end, 8);
        $this->assertEquals(8, $repository->getForRange('test', $start, $end));
    }

    public function testGetShouldReturnNullWhenNotFound()
    {
        $repository = new \Krucas\Counter\ArrayRepository();
        $this->assertNull($repository->get('test'));
    }

    public function testGetForShouldReturnNullWhenNotFound()
    {
        $date = new DateTime();
        $repository = new \Krucas\Counter\ArrayRepository();
        $this->assertNull($repository->getFor('test', $date));
    }

    public function testGetForRangeShouldReturnNullWhenNotFound()
    {
        $start = new DateTime();
        $end = new DateTime();
        $end->add(new DateInterval('P2Y4DT6H8M'));
        $repository = new \Krucas\Counter\ArrayRepository();
        $this->assertNull($repository->getForRange('test', $start, $end));
    }

    public function testHasShouldReturnBooleanValue()
    {
        $repository = new \Krucas\Counter\ArrayRepository();
        $this->assertFalse($repository->has('test'));
        $repository->set('test', 5);
        $this->assertTrue($repository->has('test'));
    }

    public function testHasForShouldReturnBooleanValue()
    {
        $date = new DateTime();
        $repository = new \Krucas\Counter\ArrayRepository();
        $this->assertFalse($repository->hasFor('test', $date));
        $repository->setFor('test', $date, 5);
        $this->assertTrue($repository->hasFor('test', $date));
    }

    public function testHasForRangeShouldReturnBooleanValue()
    {
        $start = new DateTime();
        $end = new DateTime();
        $end->add(new DateInterval('P2Y4DT6H8M'));
        $repository = new \Krucas\Counter\ArrayRepository();
        $this->assertFalse($repository->hasForRange('test', $start, $end));
        $repository->setForRange('test', $start, $end, 5);
        $this->assertTrue($repository->hasForRange('test', $start, $end));
    }

    public function testIncrementIncrementsValue()
    {
        $repository = new \Krucas\Counter\ArrayRepository();
        $repository->set('test', 5);
        $this->assertEquals(5, $repository->get('test'));
        $repository->increment('test', 1);
        $this->assertEquals(6, $repository->get('test'));
    }

    public function testIncrementCreatesValue()
    {
        $repository = new \Krucas\Counter\ArrayRepository();
        $repository->increment('test', 1);
        $this->assertEquals(1, $repository->get('test'));
    }

    public function testIncrementForIncrementsValue()
    {
        $date = new DateTime();
        $repository = new \Krucas\Counter\ArrayRepository();
        $repository->setFor('test', $date, 5);
        $this->assertEquals(5, $repository->getFor('test', $date));
        $repository->incrementFor('test', $date, 1);
        $this->assertEquals(6, $repository->getFor('test', $date));
    }

    public function testIncrementForCreatesValue()
    {
        $date = new DateTime();
        $repository = new \Krucas\Counter\ArrayRepository();
        $repository->incrementFor('test', $date, 1);
        $this->assertEquals(1, $repository->getFor('test', $date));
    }

    public function testIncrementForRangeIncrementsValue()
    {
        $start = new DateTime();
        $end = new DateTime();
        $end->add(new DateInterval('P2Y4DT6H8M'));
        $repository = new \Krucas\Counter\ArrayRepository();
        $repository->setForRange('test', $start, $end, 5);
        $this->assertEquals(5, $repository->getForRange('test', $start, $end));
        $repository->incrementForRange('test', $start, $end, 1);
        $this->assertEquals(6, $repository->getForRange('test', $start, $end));
    }

    public function testIncrementForRangeCreatesValue()
    {
        $start = new DateTime();
        $end = new DateTime();
        $end->add(new DateInterval('P2Y4DT6H8M'));
        $repository = new \Krucas\Counter\ArrayRepository();
        $repository->incrementForRange('test', $start, $end, 1);
        $this->assertEquals(1, $repository->getForRange('test', $start, $end));
    }

    public function testDecrementDecrementsValue()
    {
        $repository = new \Krucas\Counter\ArrayRepository();
        $repository->set('test', 5);
        $this->assertEquals(5, $repository->get('test'));
        $repository->decrement('test', 1);
        $this->assertEquals(4, $repository->get('test'));
    }

    public function testDecrementCreatesValue()
    {
        $repository = new \Krucas\Counter\ArrayRepository();
        $repository->decrement('test', 1);
        $this->assertEquals(-1, $repository->get('test'));
    }

    public function testDecrementForDecrementsValue()
    {
        $date = new DateTime();
        $repository = new \Krucas\Counter\ArrayRepository();
        $repository->setFor('test', $date, 5);
        $this->assertEquals(5, $repository->getFor('test', $date));
        $repository->decrementFor('test', $date, 1);
        $this->assertEquals(4, $repository->getFor('test', $date));
    }

    public function testDecrementForCreatesValue()
    {
        $date = new DateTime();
        $repository = new \Krucas\Counter\ArrayRepository();
        $repository->decrementFor('test', $date, 1);
        $this->assertEquals(-1, $repository->getFor('test', $date));
    }

    public function testDecrementForRangeDecrementsValue()
    {
        $start = new DateTime();
        $end = new DateTime();
        $end->add(new DateInterval('P2Y4DT6H8M'));
        $repository = new \Krucas\Counter\ArrayRepository();
        $repository->setForRange('test', $start, $end, 5);
        $this->assertEquals(5, $repository->getForRange('test', $start, $end));
        $repository->decrementForRange('test', $start, $end, 1);
        $this->assertEquals(4, $repository->getForRange('test', $start, $end));
    }

    public function testDecrementForRangeCreatesValue()
    {
        $start = new DateTime();
        $end = new DateTime();
        $end->add(new DateInterval('P2Y4DT6H8M'));
        $repository = new \Krucas\Counter\ArrayRepository();
        $repository->decrementForRange('test', $start, $end, 1);
        $this->assertEquals(-1, $repository->getForRange('test', $start, $end));
    }

    public function testRemoveShouldRemoveValue()
    {
        $repository = new \Krucas\Counter\ArrayRepository();
        $repository->set('test', 1);
        $this->assertTrue($repository->has('test'));
        $repository->remove('test');
        $this->assertFalse($repository->has('test'));
    }

    public function testRemoveForShouldRemoveValueForDate()
    {
        $date = new DateTime();
        $repository = new \Krucas\Counter\ArrayRepository();
        $repository->setFor('test', $date, 1);
        $this->assertTrue($repository->hasFor('test', $date));
        $repository->removeFor('test', $date);
        $this->assertFalse($repository->hasFor('test', $date));
    }

    public function testRemoveForRangeShouldRemoveValueForRange()
    {
        $start = new DateTime();
        $end = new DateTime();
        $end->add(new DateInterval('P2Y4DT6H8M'));
        $repository = new \Krucas\Counter\ArrayRepository();
        $repository->setForRange('test', $start, $end, 1);
        $this->assertTrue($repository->hasForRange('test', $start, $end));
        $repository->removeForRange('test', $start, $end);
        $this->assertFalse($repository->hasForRange('test', $start, $end));
    }
}
