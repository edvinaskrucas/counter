<?php namespace Krucas\Counter\Results\Existence;

use Krucas\Counter\Contracts\Exists as ExistsContract;

class Exists implements ExistsContract
{
    /**
     * Exists or not.
     *
     * @var bool
     */
    protected $exists;

    /**
     * @param bool $exists Exists or not.
     */
    public function __construct($exists)
    {
        $this->exists = (bool) $exists;
    }

    /**
     * Determine if value exists or not.
     *
     * @return bool
     */
    public function exists()
    {
        return $this->exists;
    }
}
