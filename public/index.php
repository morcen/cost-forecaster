<?php
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

        $study = $study * (1 + $studyGrowth * $month );
        $ramCost = 0.0053 * 24 * 30 * ($study/2); // say one month is 30 days
        $storageCost = $study/1000 * .1; // $0.10 per 1GB
        echo '<tr>';
        echo '<td>' . $now->modify('+' . $month . ' month')->format('M Y') . '</td>';
        echo '<td>' . $study . '</td>';
        echo '<td>' . $ramCost + $storageCost . '</td>';
        echo '</tr>';
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
