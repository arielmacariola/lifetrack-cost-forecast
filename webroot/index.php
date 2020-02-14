<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <script src="https://cdnjs.cloudflare.com/ajax/libs/babel-standalone/6.26.0/babel.min.js"></script>
    
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    
    <link rel="stylesheet" href="http://<?php echo $_SERVER[ 'HTTP_HOST' ] ?>/css/bootstrap.min.css">
    <script src="http://<?php echo $_SERVER[ 'HTTP_HOST' ] ?>/js/bootstrap.min.js"></script>

    <!-- Main App Resources -->
    <link rel="stylesheet" href="http://<?php echo $_SERVER[ 'HTTP_HOST' ] ?>/css/style.css">
    <script src="http://<?php echo $_SERVER[ 'HTTP_HOST' ] ?>/js/script.js"></script>

    <link rel="icon" href="images/LMSlogo-fav16.png" type="image/png" sizes="16x16">
    <link rel="icon" href="images/LMSlogo-fav32.png" type="image/png" sizes="32x32">
    
    <title>Lifetrack - Infra Cost Forecasting</title>
</head>
<body>
    <div class="main">
        <header class="container">
                <div class="logo"><img src="images/Lifetrack-Logo.png" /></div>
                <h1 class="app-title">Infra Cost Forecast</h1>
        </header>
        <div class="content container">
            <h3 class="instruction">Fill in the fields</h3>
            <form id="formForcast">
                <div class="form-group">
                    <label for="totalStudyPerDay">Number of study per day</label>
                    <input type="number" class="form-control" id="numOfStudyPerDay" min="1" max="100000000" value="1000" required>
                    <small id="totalStudyPerDayHelp" class="form-text text-muted">The value must be minimum 1 and maximum 100,000,000</small>
                </div>
                <div class="form-group">
                    <label for="numOfStudyGrowthPerMonth">Study growth per month in %</label>
                    <input type="number" class="form-control" id="numOfStudyGrowthPerMonth" min="0" max="200" value="1" required>
                    <small id="numOfStudyGrowthPerMonthHelp" class="form-text text-muted">The value must be minimum 0 and maximum 200</small>
                </div>
                <div class="form-group">
                    <label for="numOfMonthsForecast">Number of months to forecast</label>
                    <input type="number" class="form-control" id="numOfMonthsForecast" min="1" max="120" value="5" required>
                    <small id="numOfMonthsForecastHelp" class="form-text text-muted">The value must be minimum 1 and maximum 120 (10 years)</small>
                </div>
                <button type="submit" class="btn btn-info" id="submitBtn" >Submit</button>
            </form>
        </div>
        <div class="container">
            <div id="result">
                <h3 class="sub-title">Forecast Data Result</h3>
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Month Year</th>
                                <th scope="col">Number of Studies</th>
                                <th scope="col">Cost Forecasted</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td colspan="4" align="center">Please complete the form above then submit.</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <footer class="container">
            <span class="copyright">© Lifetrack Medical Systems Inc. 2020. All rights reserved.</span><br>
            <span class="staff">Developed by: <a href="https://github.com/arielmacariola" target="_blank">@arielmacariola</a></div>
        </footer>
    </div>
</body>
</html>