<?php namespace Krucas\Counter\Contracts;

interface Repository
{
    /**
     * Set value for a key.
     *
     * @param string $key Counter key.
     * @param float|int $value Value to set.
     * @return void
     */
    public function set($key, $value);

    /**
     * Set value for a key for a given date.
     *
     * @param string $key Counter key.
     * @param \DateTime $date Date.
     * @param float|int $value Value to set.
     * @return void
     */
    public function setFor($key, \DateTime $date, $value);

    /**
     * Set value for a key for a given date range.
     *
     * @param string $key Counter key.
     * @param \DateTime $start Start date.
     * @param \DateTime $end End date.
     * @param float|int $value Value to set.
     * @return void
     */
    public function setForRange($key, \DateTime $start, \DateTime $end, $value);

    /**
     * Get value for a key.
     *
     * @param string $key Counter key.
     * @return float|int|null
     */
    public function get($key);

    /**
     * Get value for a key for a given date.
     *
     * @param string $key Counter key.
     * @param \DateTime $date Date.
     * @return float|int|null
     */
    public function getFor($key, \DateTime $date);

    /**
     * Get value for a key for a given date range.
     *
     * @param string $key Counter key.
     * @param \DateTime $start Start date.
     * @param \DateTime $end End date.
     * @return float|int|null
     */
    public function getForRange($key, \DateTime $start, \DateTime $end);

    /**
     * Determine if value exists.
     *
     * @param string $key Counter key.
     * @return bool
     */
    public function has($key);

    /**
     * Determine if value exists for a given date.
     *
     * @param string $key Counter key.
     * @param \DateTime $date Date.
     * @return bool
     */
    public function hasFor($key, \DateTime $date);

    /**
     * Determine if value exists for a given date range.
     *
     * @param string $key Counter key.
     * @param \DateTime $start Start date.
     * @param \DateTime $end End date.
     * @return bool
     */
    public function hasForRange($key, \DateTime $start, \DateTime $end);

    /**
     * @param string $key Counter key.
     * @param float|int $value Value to increment.
     * @return void
     */
    public function increment($key, $value);

    /**
     * @param string $key Counter key.
     * @param \DateTime $date Date.
     * @param float|int $value Value to increment.
     * @return void
     */
    public function incrementFor($key, \DateTime $date, $value);

    /**
     * @param string $key Counter key.
     * @param \DateTime $start Start date.
     * @param \DateTime $end End date.
     * @param float|int $value Value to increment.
     * @return void
     */
    public function incrementForRange($key, \DateTime $start, \DateTime $end, $value);

    /**
     * @param string $key Counter key.
     * @param float|int $value Value to decrement.
     * @return void
     */
    public function decrement($key, $value);

    /**
     * @param string $key Counter key.
     * @param \DateTime $date Date.
     * @param float|int $value Value to decrement.
     * @return void
     */
    public function decrementFor($key, \DateTime $date, $value);

    /**
     * @param string $key Counter key.
     * @param \DateTime $start Start date.
     * @param \DateTime $end End date.
     * @param float|int $value Value to decrement.
     * @return void
     */
    public function decrementForRange($key, \DateTime $start, \DateTime $end, $value);

    /**
     * Remove value for a key.
     *
     * @param string $key Counter key.
     * @return void
     */
    public function remove($key);

    /**
     * Remove value for a key for a given date.
     *
     * @param string $key Counter key.
     * @param \DateTime $date Date.
     * @return void
     */
    public function removeFor($key, \DateTime $date);

    /**
     * Remove value for a key for a given date range.
     *
     * @param string $key Counter key.
     * @param \DateTime $start Start date.
     * @param \DateTime $end End date.
     * @return void
     */
    public function removeForRange($key, \DateTime $start, \DateTime $end);
}
