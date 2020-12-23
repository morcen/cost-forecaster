<?php

namespace LSM\Controllers;

use LSM\Models\RAM;
use LSM\Models\Serializables\ForecastCollection;
use LSM\Models\Serializables\MonthlyForecast;
use LSM\Models\SSD;

class ForecastController
{
    /**
     * @param  array  $request
     */
    public function __invoke(array $request)
    {
        $collection = $this->generateForecastCollection($request);

        header('Content-Type: application/json');
        echo json_encode($collection);
    }

    /**
     * @param  array  $request
     * @return ForecastCollection
     */
    private function generateForecastCollection(array $request): ForecastCollection
    {
        /**
         * @var $studyCount
         * @var $studyGrowth
         * @var $months
         */
        extract($request);

        $studies = $studyCount;
        $growth = $studyGrowth / 100.00;

        //prevents inaccuracies when ran during 30th/31st
        $currentMonth = (new \DateTimeImmutable())->modify('first day of this month');
        $collection = new ForecastCollection([]);
        for ($month = 1; $month <= $months; $month++) {
            // forecast starts from next month
            $forecastingMonth = $currentMonth->add(new \DateInterval("P{$month}M"));

            $ramCost = (new RAM($studies, $forecastingMonth))->computeMonthlyCost();
            $ssdCost = (new SSD($studies))->computeMonthlyCost();

            $collection->add(new MonthlyForecast($forecastingMonth, $studies, $ramCost + $ssdCost));

            $studies = $studyCount * (1 + $growth * $month );
        }

        return $collection;
    }
}
