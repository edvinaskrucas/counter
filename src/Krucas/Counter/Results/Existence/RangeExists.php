<?php namespace Krucas\Counter\Results\Existence;

use Krucas\Counter\DateRange;

class RangeExists extends Exists
{
    /**
     * Date range.
     *
     * @var \Krucas\Counter\DateRange
     */
    protected $range;

    /**
     * @param \Krucas\Counter\DateRange $range Date range.
     * @param bool $exists Exists or not.
     */
    public function __construct(DateRange $range, $exists)
    {
        $this->range = $range;
        parent::__construct($exists);
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
