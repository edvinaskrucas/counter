<?php

if (!function_exists('date_period_for_counter')) {
    /**
     * Generate \DatePeriod with a single date.
     *
     * @param \DateTime $date Desired date.
     * @return \DatePeriod
     */
    function date_period_for_counter(\DateTime $date)
    {
        $diff = $date->diff($date);
        $period = new \DatePeriod($date, $diff, 0);

        return $period;
    }
}

if (!function_exists('date_range_period_for_counter')) {
    /**
     * Generate \DatePeriod with date range set of two dates.
     *
     * @param \DateTime $start Start date.
     * @param \DateTime $end End date.
     * @return \DatePeriod
     */
    function date_range_period_for_counter(\DateTime $start, \DateTime $end)
    {
        $diff = $start->diff($end);
        $period = new \DatePeriod($start, $diff, 1);

        return $period;
    }
}