<?php

namespace LSM\Models\Serializables;

use JetBrains\PhpStorm\ArrayShape;
use JetBrains\PhpStorm\Pure;

class MonthlyForecast implements \JsonSerializable
{
    private const DATE_FORMAT = 'M Y';

    public function __construct(private \DateTimeImmutable $month, private float $studies, private float $cost)
    {
    }

    #[Pure]
    private function convertedToCurrency(string $local = 'en_US', string $currency = 'USD'): string
    {
        $formatter = new \NumberFormatter($local, \NumberFormatter::CURRENCY);

        return $formatter->formatCurrency($this->cost, $currency);
    }

    #[ArrayShape(['month' => "string", 'studies' => "false|float", 'cost' => "string"])]
    public function jsonSerialize(): array
    {
        return [
            'month' => $this->month->format(self::DATE_FORMAT),
            'studies' => ceil($this->studies),
            'cost' => $this->convertedToCurrency($this->cost)
        ];
    }
}
