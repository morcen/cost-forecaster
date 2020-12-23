<?php

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

if (!empty($_POST)) {
    $now = new DateTime();

    /**
     * @var $studyCount
     * @var $studyGrowth
     * @var $months
     */
    extract($_POST);

    $study = $studyCount;
    $studyGrowth /= 100;

    echo '<table>';
    echo '<tbody>';
    for ($month = 1; $month <= $months; $month++) {
        $currentMonth = (new DateTime())->modify('+' . $month . ' month');
        $daysInMonth = $currentMonth->format('t');

        $ramCost = (new RAM($study))->computeCostByDays($daysInMonth);
//        $storageCost = $study * Storage::STUDY_TO_STORAGE_RATIO * Storage::COST_PER_GB;
        $storageCost = ($study * .5) / 1000 * 0.1;
        echo '<tr>';
        echo '<td>' . $currentMonth->format('M Y') . "|$daysInMonth" . '</td>';
        echo '<td>' . $study . '</td>';
        echo '<td>' . $ramCost . '|' . $storageCost . ' </td>';
        echo '</tr>';

        $study = $studyCount * (1 + $studyGrowth * $month );
    }
    echo '</tbody>';
    echo '</table>';
}
?>
<html>
<body>
<div class="container">
    <section class="left">
        <form method="post" action="/compute" id="forecaster">
            <label for="studyCount">Study count per day</label>
            <input id="studyCount" name="studyCount" />
            <span id="studyCount-error" class="error-message"></span>

            <label for="studyGrowth">Study growth per month (in %)</label>
            <input id="studyGrowth" name="studyGrowth" />
            <span id="studyGrowth-error" class="error-message"></span>

            <label for="months">Number of months to forecast</label>
            <input id="months" name="months" />
            <span id="months-error" class="error-message"></span>

            <button>Submit</button>

        </form>
    </section>
    <section class="right">
        <div id="forecast"></div>
    </section>
</div>
</body>
</html>
