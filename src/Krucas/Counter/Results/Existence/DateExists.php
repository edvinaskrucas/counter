<?php namespace Krucas\Counter\Results\Existence;

class DateExists extends Exists
{
    /**
     * Date.
     *
     * @var \DateTime
     */
    protected $date;

    /**
     * @param \DateTime $date Date.
     * @param bool $exists Exists or not.
     */
    public function __construct(\DateTime $date, $exists)
    {
        $this->date = $date;
        parent::__construct($exists);
    }

    /**
     * Return date.
     *
     * @return \DateTime
     */
    public function getDate()
    {
        return $this->date;
    }
}
