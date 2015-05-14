<?php namespace Krucas\Counter;

use Krucas\Counter\Contracts\Repository;
use Krucas\Counter\Results\Existence\DateExists;
use Krucas\Counter\Results\Existence\Exists;
use Krucas\Counter\Results\Existence\RangeExists;
use Krucas\Counter\Results\Value\DateValue;
use Krucas\Counter\Results\Value\RangeValue;
use Krucas\Counter\Results\Value\Value;

class Counter
{
    /**
     * Repository implementation.
     *
     * @var \Krucas\Counter\Contracts\Repository
     */
    protected $repository;

    /**
     * Create new service.
     *
     * @param \Krucas\Counter\Contracts\Repository $repository
     */
    public function __construct(Repository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Set value for a key.
     *
     * @param string $key Counter key.
     * @param float|int $value Value to set.
     * @param \DatePeriod $period Date period.
     * @return void
     */
    public function set($key, $value, \DatePeriod $period = null)
    {
        if (is_null($period)) {
            $this->repository->set($key, $value);
        } else {
            $this->setForPeriod($key, $value, $period);
        }
    }

    /**
     * @param string $key Counter key.
     * @param float|int $value Value to set.
     * @param \DatePeriod $period Date period.
     * @return void
     */
    protected function setForPeriod($key, $value, \DatePeriod $period)
    {
        $ranges = $this->getRanges($period);

        if (count($ranges) > 0) {
            foreach ($ranges as $range) {
                $range instanceof DateRange
                    ? $this->repository->setForRange($key, $range->getStartDate(), $range->getEndDate(), $value)
                    : $this->repository->setFor($key, $range, $value);
            }
        }
    }

    /**
     * Get value for a key.
     *
     * @param string $key Counter key.
     * @param \DatePeriod $period Date period.
     * @return \Krucas\Counter\Contracts\Value|array
     */
    public function get($key, \DatePeriod $period = null)
    {
        if (is_null($period)) {
            return new Value($this->repository->get($key));
        }

        return $this->getForPeriod($key, $period);
    }

    /**
     * Return value for a given period.
     *
     * @param string $key Counter key.
     * @param \DatePeriod $period Date period.
     * @return \Krucas\Counter\Contracts\Value|array|null
     */
    protected function getForPeriod($key, \DatePeriod $period)
    {
        $ranges = $this->getRanges($period);

        if (count($ranges) > 0) {
            if (count($ranges) == 1 && !($ranges[0] instanceof DateRange)) {
                return new DateValue($ranges[0], $this->repository->getFor($key, $ranges[0]));
            }

            $values = array();

            /** @var \Krucas\Counter\DateRange $range */
            foreach ($ranges as $range) {
                $values[] = new RangeValue(
                    $range,
                    $this->repository->getForRange($key, $range->getStartDate(), $range->getEndDate())
                );
            }

            return $values;
        }

        return null;
    }

    /**
     * Determine if value exists.
     *
     * @param string $key Counter key.
     * @param \DatePeriod $period Date period.
     * @return \Krucas\Counter\Contracts\Exists|array
     */
    public function has($key, \DatePeriod $period = null)
    {
        if (is_null($period)) {
            return new Exists($this->repository->has($key));
        }

        return $this->hasForPeriod($key, $period);
    }

    /**
     * Determine if value exists for given period.
     *
     * @param string $key Counter key.
     * @param \DatePeriod $period Date period.
     * @return \Krucas\Counter\Contracts\Exists|array
     */
    protected function hasForPeriod($key, \DatePeriod $period)
    {
        $ranges = $this->getRanges($period);

        if (count($ranges) > 0) {
            if (count($ranges) == 1 && !($ranges[0] instanceof DateRange)) {
                return new DateExists($ranges[0], $this->repository->hasFor($key, $ranges[0]));
            }

            $values = array();

            /** @var \Krucas\Counter\DateRange $range */
            foreach ($ranges as $range) {
                $values[] = new RangeExists(
                    $range,
                    $this->repository->hasForRange($key, $range->getStartDate(), $range->getEndDate())
                );
            }

            return $values;
        }
    }

    /**
     * Increment value.
     *
     * @param string $key Counter key.
     * @param float|int $value Increment by value.
     * @param \DatePeriod $period Date period.
     * @return void
     */
    public function increment($key, $value, \DatePeriod $period = null)
    {
        if (is_null($period)) {
            $this->repository->increment($key, $value);
        } else {
            $this->incrementForPeriod($key, $value, $period);
        }
    }

    /**
     * Increment value for a given period.
     *
     * @param string $key Counter key.
     * @param float|int $value Increment by value.
     * @param \DatePeriod $period Date period.
     * @return void
     */
    protected function incrementForPeriod($key, $value, \DatePeriod $period)
    {
        $ranges = $this->getRanges($period);

        if (count($ranges) > 0) {
            foreach ($ranges as $range) {
                $range instanceof DateRange
                    ? $this->repository->incrementForRange($key, $range->getStartDate(), $range->getEndDate(), $value)
                    : $this->repository->incrementFor($key, $range, $value);
            }
        }
    }

    /**
     * Decrement value.
     *
     * @param string $key Counter key.
     * @param float|int $value Decrement by value.
     * @param \DatePeriod $period Date period.
     * @return void
     */
    public function decrement($key, $value, \DatePeriod $period = null)
    {
        if (is_null($period)) {
            $this->repository->decrement($key, $value);
        } else {
            $this->decrementForPeriod($key, $value, $period);
        }
    }

    /**
     * Decrement value for a given period.
     *
     * @param string $key Counter key.
     * @param float|int $value Decrement by value.
     * @param \DatePeriod $period Date period.
     * @return void
     */
    protected function decrementForPeriod($key, $value, \DatePeriod $period)
    {
        $ranges = $this->getRanges($period);

        if (count($ranges) > 0) {
            foreach ($ranges as $range) {
                $range instanceof DateRange
                    ? $this->repository->decrementForRange($key, $range->getStartDate(), $range->getEndDate(), $value)
                    : $this->repository->decrementFor($key, $range, $value);
            }
        }
    }

    /**
     * Remove value.
     *
     * @param string $key Counter key.
     * @param \DatePeriod $period Date period.
     * @return void
     */
    public function remove($key, \DatePeriod $period = null)
    {
        if (is_null($period)) {
            $this->repository->remove($key);
        } else {
            $this->removeForPeriod($key, $period);
        }
    }

    /**
     * Remove value for a given period.
     *
     * @param string $key Counter key.
     * @param \DatePeriod $period Date period.
     * @return void
     */
    protected function removeForPeriod($key, \DatePeriod $period)
    {
        $ranges = $this->getRanges($period);

        if (count($ranges) > 0) {
            foreach ($ranges as $range) {
                $range instanceof DateRange
                    ? $this->repository->removeForRange($key, $range->getStartDate(), $range->getEndDate())
                    : $this->repository->removeFor($key, $range);
            }
        }
    }

    /**
     * Generate date ranges from given period.
     *
     * @param \DatePeriod $period Date period.
     * @return array
     */
    protected function getRanges(\DatePeriod $period)
    {
        $ranges = array();

        $start = null;
        $end = null;
        $single = true;

        foreach ($period as $i => $date) {
            // Set single date
            $ranges[$i] = $date;

            // This is interval, so set it.
            if ($i > 0) {
                $ranges[$i - 1] = new DateRange($ranges[$i - 1], $date);
                $single = false;
            }
        }

        // Ranges are stored, so we don't need las element
        if (!$single) {
            array_pop($ranges);
        }

        return $ranges;
    }
}
