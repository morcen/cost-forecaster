<?php

namespace Forecost\Models;

use JetBrains\PhpStorm\Pure;
use Forecost\Models\Interfaces\StorageModelInterface;

class RAM implements StorageModelInterface
{
    private const COST_PER_GIG_PER_HOUR = 0.00553;
    private const MIN_RAM_INCREMENT = 500;
    private const STUDIES_TO_RAM_RATIO = 0.5;
    private const MB_TO_GB = 1000;
    private const HOURS_PER_DAY = 24;

    public function __construct(private int $studies, private \DateTimeImmutable $month)
    {
    }

    /**
     * @return float|int
     */
    public function computeMonthlyCost(): float | int
    {
        $days = $this->month->format('t');

        return $this->totalRAMHourlyCost() // hourly cost
            * self::HOURS_PER_DAY // daily cost
            * $days;
    }

    /**
     * @return float|int
     */
    #[Pure]
    private function RAMRequiredInGb(): float | int
    {
        $RAMCount = ceil(($this->studies * self::STUDIES_TO_RAM_RATIO) / self::MIN_RAM_INCREMENT);

        return ($RAMCount * self::MIN_RAM_INCREMENT) / self::MB_TO_GB;
    }

    /**
     * @return float|int
     */
    #[Pure]
    private function totalRAMHourlyCost(): float | int
    {
        return $this->RAMRequiredInGb() * self::COST_PER_GIG_PER_HOUR;
    }
}
