<?php namespace Krucas\Counter\Results\Value;

class DateValue extends Value
{
    /**
     * Date.
     *
     * @var \DateTime
     */
    protected $date;

    /**
     * @param \DateTime $date Date.
     * @param float|int|null $value Result value.
     */
    public function __construct(\DateTime $date, $value)
    {
        $this->date = $date;
        parent::__construct($value);
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
