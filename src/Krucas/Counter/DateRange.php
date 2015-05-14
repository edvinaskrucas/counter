<?php namespace Krucas\Counter;

class DateRange
{
    /**
     * Start date.
     *
     * @var \DateTime
     */
    protected $startDate;

    /**
     * End date.
     *
     * @var \DateTime
     */
    protected $endDate;

    /**
     * @param \DateTime $startDate Start date.
     * @param \DateTime $endDate End date.
     */
    public function __construct(\DateTime $startDate, \DateTime $endDate)
    {
        $this->startDate = $startDate;
        $this->endDate = $endDate;
    }

    /**
     * Return start date.
     *
     * @return \DateTime
     */
    public function getStartDate()
    {
        return $this->startDate;
    }

    /**
     * Return end date.
     *
     * @return \DateTime
     */
    public function getEndDate()
    {
        return $this->endDate;
    }
}
