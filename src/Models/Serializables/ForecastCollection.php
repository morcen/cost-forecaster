<?php

namespace LSM\Models\Serializables;

class ForecastCollection implements \JsonSerializable
{
    public function __construct(private array $monthlyForecasts)
    {
    }

    /**
     * @param  MonthlyForecast  $monthlyForecast
     */
    public function add(MonthlyForecast $monthlyForecast)
    {
        $this->monthlyForecasts[] = $monthlyForecast;
    }

    /**
     * @return array
     */
    public function jsonSerialize(): array
    {
        return $this->monthlyForecasts;
    }
}
