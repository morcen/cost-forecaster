<?php

namespace LSM\Models;

class SSD
{
    const COST_PER_GB = 0.1;
    const MIN_STORAGE_INCREMENT = 1000;
    const STUDY_TO_MB_RATIO = 10;

    public function __construct(private int $studies) {}

    public function computeCostMonthly()
    {
        return $this->storageRequiredInGb() * self::COST_PER_GB;
    }

    public function storageRequiredInGb()
    {
        return ceil(($this->studies * self::STUDY_TO_MB_RATIO) / self::MIN_STORAGE_INCREMENT);
    }
}
