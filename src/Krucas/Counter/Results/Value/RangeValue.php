<?php namespace Krucas\Counter\Results\Value;

use Krucas\Counter\DateRange;

class RangeValue extends Value
{
    /**
     * Date range.
     *
     * @var \Krucas\Counter\DateRange
     */
    protected $range;

    /**
     * @param \Krucas\Counter\DateRange $range Date range.
     * @param float|int|null $value Result value.
     */
    public function __construct(DateRange $range, $value)
    {
        $this->range = $range;
        parent::__construct($value);
    }

    /**
     * Return date range.
     *
     * @return \Krucas\Counter\DateRange
     */
    public function getRange()
    {
        return $this->range;
    }
}
