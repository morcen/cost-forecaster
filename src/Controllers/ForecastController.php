<?php

namespace LSM\Controllers;

use LSM\Models\Forms\ForecastForm;
use LSM\Models\RAM;
use LSM\Models\Serializables\ForecastCollection;
use LSM\Models\Serializables\MonthlyForecast;
use LSM\Models\SSD;
use LSM\Services\ValidationService;

final class ForecastController implements BaseController
{
    private int $studyCount;
    private float | int $studyGrowth;
    private int $months;

    /**
     * @param  array  $request
     */
    public function __invoke(array $request)
    {
        $validation = new ValidationService(new ForecastForm());
        $validation->validate($request);

        $this->studyCount = $request['studyCount'];
        $this->studyGrowth = $request['studyGrowth'] / 100; // from percentage to decimal
        $this->months = $request['months'];

        $collection = $this->generateForecastCollection();

        header('Content-Type: application/json');
        echo json_encode($collection);
    }

    /**
     * @return ForecastCollection
     */
    private function generateForecastCollection(): ForecastCollection
    {
        //prevents inaccuracies when ran during 30th/31st
        $currentMonth = (new \DateTimeImmutable())->modify('first day of this month');

        $collection = new ForecastCollection([]);
        for (
            $studies = $this->studyCount, $month = 1;
            $month <= $this->months;
            $month++, $studies = $this->growthByMonth($month)
        ) {
            // forecast starts from next month
            $forecastingMonth = $currentMonth->add(new \DateInterval("P{$month}M"));

            $ramCost = (new RAM($studies, $forecastingMonth))->computeMonthlyCost();
            $ssdCost = (new SSD($studies))->computeMonthlyCost();

            $collection->add(new MonthlyForecast($forecastingMonth, $studies, $ramCost + $ssdCost));
        }

        return $collection;
    }

    /**
     * @param $month
     * @return float|int
     */
    private function growthByMonth($month): float | int
    {
        return $this->studyCount * (1 + $this->studyGrowth * $month);
    }
}
