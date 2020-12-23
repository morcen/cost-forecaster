<?php

namespace LSM\Models;

class RAM
{
    const COST_PER_GIG_PER_HOUR = 0.00553;
    const RAM_INCREMENT = 500;
    const STUDIES_TO_RAM_RATIO = 0.5;

    public function __construct(private int $studies) {}

    /**
     * @param  int  $days
     * @return float|int
     */
    public function computeCostByDays(int $days)
    {
        return $this->totalRAMHourlyCost()
            * 24 // daily cost
            * $days;
    }

    public function totalRAM()
    {
        return ceil(($this->studies * self::STUDIES_TO_RAM_RATIO) / self::RAM_INCREMENT) * self::RAM_INCREMENT ;
    }

    public function totalRAMHourlyCost()
    {
        return ($this->totalRAM() / 1000) * self::COST_PER_GIG_PER_HOUR;
    }
}
