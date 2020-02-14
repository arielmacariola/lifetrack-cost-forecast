<?php
/**
 * CostForecast class is use to generate monthly cost forecast
 * 
 */
class CostForecast {

    // vars for RAM
    public $studiesToRamRatio;
    public $ramToStudiesRatioInMb;
    public $ram1GbPerHourCost;

    // vars for storage
    public $storageUsePerStudyInMb;
    public $storage1GbPerMonthCost;
    
    private $ramPerStudyCostIn1Day;
    private $forecastData = [];

    function __construct( $props = [] ) {

        // Initialise default computation parameter values
        $this->studiesToRamRatio      = 1000;
        $this->ramToStudiesRatioMB    = 500;
        $this->ram1GbPerHourCost      = 0.00553;
        $this->storageUsePerStudyInMb = 10;
        $this->storage1GbPerMonthCost = 0.10;

        // Set property value if given
        foreach( $props as $name => $value ) :
            if( property_exists ( $this, $name) ) :
                $this->$name = $value;
            endif;
        endforeach;

        $this->ramPerStudyCostIn1Day  = $this->computeRamPerStudyCostIn1Day();
        
    }

    /**
     * Compute costing of RAM usage for each Study in 1 day
     * 
     */
    private function computeRamPerStudyCostIn1Day() {
        $ramNeededPerStudyInMB = $this->ramToStudiesRatioMB / $this->studiesToRamRatio;
        $ram1MbPerHourCost     = $this->ram1GbPerHourCost / 1000;
        $ramPerStudyCost       = $ramNeededPerStudyInMB * $ram1MbPerHourCost * 24;

        return $ramPerStudyCost;
    }

    /**
     * Generate a JSON data of cost forecast
     * 
     * @param int  $numOfStudiesPerDay This is the given POST data for the number of studies per day
     * @param float $totalStorageCostThisMonth This is the given POST data for the growth percentage per month
     * @param int $numOfMonthForecast This is the given POST data for the number of months to forecast from the current month
     * 
     */
    public function getCostForecastDataInJSON( $numOfStudiesPerDay, $growthPercentagePerMonth, $numOfMonthForecast ) {
        
        $forecastCtr = 1;
        $numberOfStudies = $numOfStudiesPerDay;

        while ( $forecastCtr <= $numOfMonthForecast ) :

            // Month - Year label
            $monthYearLabel = date("M Y", strtotime( "+" . $forecastCtr - 1 . " month", time() ));

            // Get number of days in forecasted month
            $numberOfDaysInAMonth = $this->getNumberOfDaysInAMonth( $forecastCtr - 1 );

            // Get new number of studies with Growth Percentage added
            $numberOfStudies = intval( $numberOfStudies + $numberOfStudies * ($growthPercentagePerMonth / 100) );

            // Get total number of Studies in forcasted month
            $numOfStudiesThisMonth = $numberOfStudies * $numberOfDaysInAMonth;
            
            // Get total cost for RAM usage in forcasted month
            $totalRamCostThisMonth = $this->ramPerStudyCostIn1Day * $numOfStudiesThisMonth;
           
            // Get total cost for Storage usage in forcasted month
            $totalStorageCostThisMonth = ( ( $numberOfStudies * $this->storageUsePerStudyInMb * $numberOfDaysInAMonth ) / 1000 ) * $this->storage1GbPerMonthCost;

            $totalCostForcasted = $totalRamCostThisMonth + $totalStorageCostThisMonth;

            $this->forecastData[] = [ 
                    "monthYearLabel"        => $monthYearLabel, 
                    "numOfStudiesThisMonth" => number_format( $numOfStudiesThisMonth, 0, '', ','),
                    "totalCostForcasted"    => "$" . number_format( $totalCostForcasted, 2, '.', ',')
                ];

            $forecastCtr++;

        endwhile;
        
        return $this->forecastData;
    }

    /**
     * Get number of days in a month
     * 
     * @param int $increaseMonthBy This method will get the number of days in a given month
     * 
     */
    private function getNumberOfDaysInAMonth( $increaseMonthBy = 0) {
        $dataStr  = date("Y-m-d", strtotime( "+" . $increaseMonthBy . " month", time() ));
        $monthNow = date('n', strtotime($dataStr));
        $yearNow  = date('Y', strtotime($dataStr));

        return cal_days_in_month(CAL_GREGORIAN, $monthNow, $yearNow);
    }
}