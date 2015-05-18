<?php namespace Krucas\Counter\Results\Value;

use Krucas\Counter\Contracts\Value as ValueContract;

class Value implements ValueContract
{
    /**
     * Result value.
     *
     * @var float|int|null
     */
    protected $value;

    /**
     * @param float|int|null $value Result value.
     */
    public function __construct($value)
    {
        $this->value = $value;
    }

    /**
     * Return value.
     *
     * @return float|int|null
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return (string) $this->getValue();
    }
}
