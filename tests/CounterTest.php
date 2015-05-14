<?php

use Mockery as m;

class CounterTest extends PHPUnit_Framework_TestCase
{
    public function tearDown()
    {
        m::close();
    }

    public function testSetShouldSetDataForNonPeriodValue()
    {
        $repository = new \Krucas\Counter\ArrayRepository();

        $counter = new \Krucas\Counter\Counter($repository);
        $counter->set('test', 5);

        $this->assertEquals(5, $counter->get('test')->getValue());
    }

    public function testSetShouldSetDataForGivenDate()
    {
        $repository = new \Krucas\Counter\ArrayRepository();

        $date = new DateTime();
        $interval = new DateInterval('PT0S');
        $period = new DatePeriod($date, $interval, 0);

        $counter = new \Krucas\Counter\Counter($repository);
        $counter->set('test', 5, $period);

        $this->assertTrue($counter->get('test', $period) instanceof \Krucas\Counter\Results\Value\DateValue);
        $this->assertEquals(5, $counter->get('test', $period)->getValue());
    }

    public function testSetShouldSetDataForDataWithPeriod()
    {
        $repository = new \Krucas\Counter\ArrayRepository();

        $date = new DateTime();
        $interval = new DateInterval('P1M');
        $period = new DatePeriod($date, $interval, 5);

        $counter = new \Krucas\Counter\Counter($repository);
        $counter->set('test', 5, $period);

        $results = $counter->get('test', $period);

        $this->assertCount(5, $results);

        foreach ($results as $value) {
            $this->assertTrue($value instanceof \Krucas\Counter\Results\Value\RangeValue);
            $this->assertEquals(5, $value->getValue());
        }
    }

    public function testHasShouldDetermineIfValueExists()
    {
        $repository = new \Krucas\Counter\ArrayRepository();

        $counter = new \Krucas\Counter\Counter($repository);

        $this->assertFalse($counter->has('test')->exists());

        $counter->set('test', 5);

        $this->assertTrue($counter->has('test')->exists());
    }

    public function testHasShouldDetermineIfValueExistsForDate()
    {
        $repository = new \Krucas\Counter\ArrayRepository();

        $counter = new \Krucas\Counter\Counter($repository);

        $date = new DateTime();
        $interval = new DateInterval('PT0S');
        $period = new DatePeriod($date, $interval, 0);

        $this->assertFalse($counter->has('test', $period)->exists());

        $counter->set('test', 5, $period);

        $this->assertTrue($counter->has('test', $period)->exists());
    }

    public function testHasShouldDetermineIfValueExistsForPeriod()
    {
        $repository = new \Krucas\Counter\ArrayRepository();

        $counter = new \Krucas\Counter\Counter($repository);

        $date = new DateTime();
        $interval = new DateInterval('P1M');
        $period = new DatePeriod($date, $interval, 5);

        $results = $counter->has('test', $period);

        foreach ($results as $result) {
            $this->assertFalse($result->exists());
        }

        $counter->set('test', 5, $period);

        $results = $counter->has('test', $period);

        foreach ($results as $result) {
            $this->assertTrue($result->exists());
        }
    }

    public function testIncrementShouldIncrementValue()
    {
        $repository = m::mock('Krucas\Counter\Contracts\Repository');
        $repository->shouldReceive('increment')->once();

        $counter = new \Krucas\Counter\Counter($repository);
        $counter->increment('test', 1);
    }

    public function testIncrementShouldIncrementValueForDate()
    {
        $repository = m::mock('Krucas\Counter\Contracts\Repository');
        $repository->shouldReceive('incrementFor')->once();

        $date = new DateTime();
        $interval = new DateInterval('PT0S');
        $period = new DatePeriod($date, $interval, 0);

        $counter = new \Krucas\Counter\Counter($repository);
        $counter->increment('test', 1, $period);
    }

    public function testIncrementShouldIncrementValueForRange()
    {
        $repository = m::mock('Krucas\Counter\Contracts\Repository');
        $repository->shouldReceive('incrementForRange')->times(5);

        $date = new DateTime();
        $interval = new DateInterval('P1M');
        $period = new DatePeriod($date, $interval, 5);

        $counter = new \Krucas\Counter\Counter($repository);
        $counter->increment('test', 1, $period);
    }

    public function testDecrementShouldDecrementValue()
    {
        $repository = m::mock('Krucas\Counter\Contracts\Repository');
        $repository->shouldReceive('decrement')->once();

        $counter = new \Krucas\Counter\Counter($repository);
        $counter->decrement('test', 1);
    }

    public function testDecrementShouldDecrementValueForDate()
    {
        $repository = m::mock('Krucas\Counter\Contracts\Repository');
        $repository->shouldReceive('decrementFor')->once();

        $date = new DateTime();
        $interval = new DateInterval('PT0S');
        $period = new DatePeriod($date, $interval, 0);

        $counter = new \Krucas\Counter\Counter($repository);
        $counter->decrement('test', 1, $period);
    }

    public function testDecrementShouldDecrementValueForRange()
    {
        $repository = m::mock('Krucas\Counter\Contracts\Repository');
        $repository->shouldReceive('decrementForRange')->times(5);

        $date = new DateTime();
        $interval = new DateInterval('P1M');
        $period = new DatePeriod($date, $interval, 5);

        $counter = new \Krucas\Counter\Counter($repository);
        $counter->decrement('test', 1, $period);
    }

    public function testRemoveShouldRemoveValue()
    {
        $repository = m::mock('Krucas\Counter\Contracts\Repository');
        $repository->shouldReceive('remove')->once();

        $counter = new \Krucas\Counter\Counter($repository);
        $counter->remove('test');
    }

    public function testRemoveShouldRemoveValueForDate()
    {
        $repository = m::mock('Krucas\Counter\Contracts\Repository');
        $repository->shouldReceive('removeFor')->once();

        $date = new DateTime();
        $interval = new DateInterval('PT0S');
        $period = new DatePeriod($date, $interval, 0);

        $counter = new \Krucas\Counter\Counter($repository);
        $counter->remove('test', $period);
    }

    public function testRemoveShouldRemoveValueForRange()
    {
        $repository = m::mock('Krucas\Counter\Contracts\Repository');
        $repository->shouldReceive('removeForRange')->times(5);

        $date = new DateTime();
        $interval = new DateInterval('P1M');
        $period = new DatePeriod($date, $interval, 5);

        $counter = new \Krucas\Counter\Counter($repository);
        $counter->remove('test', $period);
    }
}
