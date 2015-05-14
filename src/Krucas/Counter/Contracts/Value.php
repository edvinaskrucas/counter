<?php namespace Krucas\Counter\Contracts;

interface Value
{
    /**
     * Return value.
     *
     * @return float|int|null
     */
    public function getValue();
}
