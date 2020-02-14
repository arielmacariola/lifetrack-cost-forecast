<?php
include_once('CostForecast.php');

$contentType = isset($_SERVER["CONTENT_TYPE"]) ? trim($_SERVER["CONTENT_TYPE"]) : '';

if ($contentType === "application/json") :
  //Receive the RAW post data.
  $content = trim(file_get_contents("php://input"));

  $postData = json_decode($content, true);

    //If json_decode failed, the JSON is invalid.
    if( is_array($postData) ) :
        $numOfStudiesPerDay       = ( isset( $postData['numberOfStudiesPerDay'] ) ) ? $postData['numberOfStudiesPerDay'] : 0;
        $growthPercentagePerMonth = ( isset( $postData['growthPercentagePerMonth'] ) ) ? $postData['growthPercentagePerMonth'] : 0;
        $numOfMonthForecast       = ( isset( $postData['numOfMonthForecast'] ) ) ? $postData['numOfMonthForecast'] : 0;

        // Set forecast options here
        $CostForecast = new CostForecast();
        $CostForecast->studiesToRamRatio      = 1000;
        $CostForecast->ramToStudiesRatioMB    = 500;
        $CostForecast->ram1GbPerHourCost      = 0.00553;
        $CostForecast->storageUsePerStudyInMb = 10;
        $CostForecast->storage1GbPerMonthCost = 0.10;

        $response = $CostForecast->getCostForecastDataInJSON($numOfStudiesPerDay, $growthPercentagePerMonth, $numOfMonthForecast);

        echo json_encode( $response );
    else :
        echo json_decode( ['error' => 'POST data is required.'] );
    endif;
endif;