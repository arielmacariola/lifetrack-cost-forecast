<?php
include_once('CostForecast.php');

$contentType = isset($_SERVER["CONTENT_TYPE"]) ? trim($_SERVER["CONTENT_TYPE"]) : '';

if ($contentType === "application/json") :
  //Receive the RAW post data.
  $content = trim(file_get_contents("php://input"));

  $postData = json_decode($content, true);

    //If json_decode failed, the JSON is invalid.
    if( is_array($postData) &&
        isset( $postData['numberOfStudiesPerDay'] ) &&
        isset( $postData['growthPercentagePerMonth'] ) &&
        isset( $postData['numOfMonthForecast'] ) ) :

        // Set forecast options here
        $options = [
            "studiesToRamRatio"      => 1000,
            "ramToStudiesRatioMB"    => 500,
            "ram1GbPerHourCost"      => 0.00553,
            "storageUsePerStudyInMb" => 10,
            "storage1GbPerMonthCost" => 0.10,
        ];
        $CostForecast = new CostForecast( $options );
        $response     = $CostForecast->getCostForecastDataInJSON( $postData['numberOfStudiesPerDay'], $postData['growthPercentagePerMonth'], $postData['numOfMonthForecast'] );

        echo json_encode( $response );
    else :
        echo json_encode( ['error' => 'All input fields are required.' ] );
    endif;
endif;