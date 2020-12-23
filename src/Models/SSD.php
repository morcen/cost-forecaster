<?php

namespace LSM\Models;

use JetBrains\PhpStorm\Pure;
use LSM\Models\Interfaces\StorageModelInterface;

class SSD implements StorageModelInterface
{
    private const COST_PER_GB = 0.1;
    private const MIN_STORAGE_INCREMENT = 1000;
    private const STUDY_TO_MB_RATIO = 10;

    public function __construct(private int $studies)
    {
    }

    #[Pure]
    public function computeMonthlyCost(): float | int
    {
        return $this->storageRequiredInGb() * self::COST_PER_GB;
    }

    #[Pure]
    public function storageRequiredInGb(): float
    {
        return ceil(($this->studies * self::STUDY_TO_MB_RATIO) / self::MIN_STORAGE_INCREMENT);
    }
}
