<?php namespace Krucas\Counter\Contracts;

interface Exists
{
    /**
     * Determine if value exists or not.
     *
     * @return bool
     */
    public function exists();
}
