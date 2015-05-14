<?php namespace Krucas\Counter;

use Krucas\Counter\Contracts\Repository;

class ArrayRepository implements Repository
{
    /**
     * Counter data.
     *
     * @var array
     */
    protected $data = array();

    /**
     * Set value for a key.
     *
     * @param string $key Counter key.
     * @param float|int $value Value to set.
     * @return void
     */
    public function set($key, $value)
    {
        $this->data[$this->key($key)] = $value;
    }

    /**
     * Set value for a key for a given date.
     *
     * @param string $key Counter key.
     * @param \DateTime $date Date.
     * @param float|int $value Value to set.
     * @return void
     */
    public function setFor($key, \DateTime $date, $value)
    {
        $this->data[$this->keyFor($key, $date)] = $value;
    }

    /**
     * Set value for a key for a given date range.
     *
     * @param string $key Counter key.
     * @param \DateTime $start Start date.
     * @param \DateTime $end End date.
     * @param float|int $value Value to set.
     * @return void
     */
    public function setForRange($key, \DateTime $start, \DateTime $end, $value)
    {
        $this->data[$this->keyForRange($key, $start, $end)] = $value;
    }

    /**
     * Get value for a key.
     *
     * @param string $key Counter key.
     * @return float|int|null
     */
    public function get($key)
    {
        if (!$this->has($key)) {
            return null;
        }

        return $this->data[$this->key($key)];
    }

    /**
     * Get value for a key for a given date.
     *
     * @param string $key Counter key.
     * @param \DateTime $date Date.
     * @return float|int|null
     */
    public function getFor($key, \DateTime $date)
    {
        if (!$this->hasFor($key, $date)) {
            return null;
        }

        return $this->data[$this->keyFor($key, $date)];
    }

    /**
     * Get value for a key for a given date range.
     *
     * @param string $key Counter key.
     * @param \DateTime $start Start date.
     * @param \DateTime $end End date.
     * @return float|int|null
     */
    public function getForRange($key, \DateTime $start, \DateTime $end)
    {
        if (!$this->hasForRange($key, $start, $end)) {
            return null;
        }

        return $this->data[$this->keyForRange($key, $start, $end)];
    }

    /**
     * Determine if value exists.
     *
     * @param string $key Counter key.
     * @return bool
     */
    public function has($key)
    {
        return array_key_exists($this->key($key), $this->data);
    }

    /**
     * Determine if value exists for a given date.
     *
     * @param string $key Counter key.
     * @param \DateTime $date Date.
     * @return bool
     */
    public function hasFor($key, \DateTime $date)
    {
        return array_key_exists($this->keyFor($key, $date), $this->data);
    }

    /**
     * Determine if value exists for a given date range.
     *
     * @param string $key Counter key.
     * @param \DateTime $start Start date.
     * @param \DateTime $end End date.
     * @return bool
     */
    public function hasForRange($key, \DateTime $start, \DateTime $end)
    {
        return array_key_exists($this->keyForRange($key, $start, $end), $this->data);
    }

    /**
     * @param string $key Counter key.
     * @param float|int $value Value to increment.
     * @return void
     */
    public function increment($key, $value)
    {
        if ($this->has($key)) {
            $this->set($key, $this->get($key) + $value);
        } else {
            $this->set($key, $value);
        }
    }

    /**
     * @param string $key Counter key.
     * @param \DateTime $date Date.
     * @param float|int $value Value to increment.
     * @return void
     */
    public function incrementFor($key, \DateTime $date, $value)
    {
        if ($this->hasFor($key, $date)) {
            $this->setFor($key, $date, $this->getFor($key, $date) + $value);
        } else {
            $this->setFor($key, $date, $value);
        }
    }

    /**
     * @param string $key Counter key.
     * @param \DateTime $start Start date.
     * @param \DateTime $end End date.
     * @param float|int $value Value to increment.
     * @return void
     */
    public function incrementForRange($key, \DateTime $start, \DateTime $end, $value)
    {
        if ($this->hasForRange($key, $start, $end)) {
            $this->setForRange($key, $start, $end, $this->getForRange($key, $start, $end) + $value);
        } else {
            $this->setForRange($key, $start, $end, $value);
        }
    }

    /**
     * @param string $key Counter key.
     * @param float|int $value Value to decrement.
     * @return void
     */
    public function decrement($key, $value)
    {
        if ($this->has($key)) {
            $this->set($key, $this->get($key) - $value);
        } else {
            $this->set($key, -$value);
        }
    }

    /**
     * @param string $key Counter key.
     * @param \DateTime $date Date.
     * @param float|int $value Value to decrement.
     * @return void
     */
    public function decrementFor($key, \DateTime $date, $value)
    {
        if ($this->hasFor($key, $date)) {
            $this->setFor($key, $date, $this->getFor($key, $date) - $value);
        } else {
            $this->setFor($key, $date, -$value);
        }
    }

    /**
     * @param string $key Counter key.
     * @param \DateTime $start Start date.
     * @param \DateTime $end End date.
     * @param float|int $value Value to decrement.
     * @return void
     */
    public function decrementForRange($key, \DateTime $start, \DateTime $end, $value)
    {
        if ($this->hasForRange($key, $start, $end)) {
            $this->setForRange($key, $start, $end, $this->getForRange($key, $start, $end) - $value);
        } else {
            $this->setForRange($key, $start, $end, -$value);
        }
    }

    /**
     * Generate key.
     *
     * @param string $key Counter key.
     * @return string
     */
    protected function key($key)
    {
        return 'standard:' . $key;
    }

    /**
     * Generate key for date.
     *
     * @param string $key Counter key.
     * @param \DateTime $date Date.
     * @return string
     */
    protected function keyFor($key, \DateTime $date)
    {
        return 'date:' . $key . '_' . $this->dateString($date);
    }

    /**
     * Generate key for key and date range.
     *
     * @param string $key Counter key.
     * @param \DateTime $start Start date.
     * @param \DateTime $end End date.
     * @return string
     */
    protected function keyForRange($key, \DateTime $start, \DateTime $end)
    {
        return 'range:' . $key . '_' . $this->dateString($start) . '_' . $this->dateString($end);
    }

    /**
     * Convert date to string.
     *
     * @param \DateTime $date Date.
     * @return string
     */
    protected function dateString(\DateTime $date)
    {
        return $date->format('U');
    }

    /**
     * Remove value for a key.
     *
     * @param string $key Counter key.
     * @return void
     */
    public function remove($key)
    {
        unset($this->data[$this->key($key)]);
    }

    /**
     * Remove value for a key for a given date.
     *
     * @param string $key Counter key.
     * @param \DateTime $date Date.
     * @return void
     */
    public function removeFor($key, \DateTime $date)
    {
        unset($this->data[$this->keyFor($key, $date)]);
    }

    /**
     * Remove value for a key for a given date range.
     *
     * @param string $key Counter key.
     * @param \DateTime $start Start date.
     * @param \DateTime $end End date.
     * @return void
     */
    public function removeForRange($key, \DateTime $start, \DateTime $end)
    {
        unset($this->data[$this->keyForRange($key, $start, $end)]);
    }
}
