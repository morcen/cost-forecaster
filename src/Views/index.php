<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <link rel="stylesheet" href="<?php echo ASSETS; ?>css/app.css"/>
    <title>Cost Forecaster</title>
</head>
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
<script src="<?php echo ASSETS; ?>js/app.js"></script>
</body>
</html>
