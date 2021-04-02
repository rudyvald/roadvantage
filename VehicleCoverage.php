<?php

/*
    PHP Developer Test 17 Submission
    Author: Rudy Valdez
    Date: 4/2/2021

    Run all tests with the public method testAllVehicles()

    Included is another method to test a vehile individually testVehicle()
*/

class VehicleCoverage{

    private $coverage = [];

    private $issue_mileage = array(
        array("min" => 0, "max" => 12000, "suffix2" => "A"),
        array("min" => 12001, "max" => 24000, "suffix2" => "A"),
        array("min" => 24001, "max" => 36000, "suffix2" => "B"),
        array("min" => 36001, "max" => 48000, "suffix2" => "C"),
        array("min" => 48001, "max" => 60000, "suffix2" => "D"),
        array("min" => 60001, "max" => 72000, "suffix2" => "E"),
        array("min" => 72001, "max" => 84000, "suffix2" => "F"),
        array("min" => 84001, "max" => 96000, "suffix2" => "G"),
        array("min" => 96001, "max" => 108000, "suffix2" => "H"),
        array("min" => 108001, "max" => 120000, "suffix2" => "I"),
        array("min" => 120001, "max" => 132000, "suffix2" => "J"),
        array("min" => 132001, "max" => 144000, "suffix2" => "K"),
        array("min" => 144001, "max" => 150000, "suffix2" => "L")
    );

    private $base_warranty = array(
        array("make" => "BMW", "term" => 36, "miles" => 48000),
        array("make" => "Volkswagen", "term" => 72, "miles" => 100000)
    );

    private $years = array(
        array("modelyear" => 2003, "suffix1" => 15),
        array("modelyear" => 2004, "suffix1" => 14),
        array("modelyear" => 2005, "suffix1" => 13),
        array("modelyear" => 2006, "suffix1" => 12),
        array("modelyear" => 2007, "suffix1" => 11),
        array("modelyear" => 2008, "suffix1" => 10),
        array("modelyear" => 2009, "suffix1" => 9),
        array("modelyear" => 2010, "suffix1" => 8),
        array("modelyear" => 2011, "suffix1" => 7),
        array("modelyear" => 2012, "suffix1" => 6),
        array("modelyear" => 2013, "suffix1" => 5),
        array("modelyear" => 2014, "suffix1" => 4),
        array("modelyear" => 2015, "suffix1" => 3),
        array("modelyear" => 2016, "suffix1" => 2),
        array("modelyear" => 2017, "suffix1" => 1),
        array("modelyear" => 2018, "suffix1" => 0),
        array("modelyear" => 2019, "suffix1" => 0));

    private $maxMiles = 153000;
    private $maxAge = 147;

    public function __construct(){
        $this->coverage = $this->getCoverage();
    }

    // Main run function
	public function testAllVehicles()
	{
        foreach($this->base_warranty as $key => $vehicle){ // Check each vehicle
            foreach($this->years as $key => $year){ // For each vehicle, check each model year
                // Loop from 1,000 to 150,000 for every mileage possible
                for ($miles=1000; $miles <=150000; $miles+=1000){
                    // Check every coverage
                    foreach($this->coverage as $key => $ncoverage){
                        $this->testCoverage($vehicle, $year, $miles, $ncoverage);
                    }
                }
            }
        }        
	}

    public function testVehicle($war, $yr, $cov, $mil){
        $testMake = $this->base_warranty[$war];
        $testYear = $this->years[$yr];
        $testMiles = $mil;
        $testCoverage = $this->coverage[$cov];
        $vehAge = $this->getVehAge($testYear); 

        echo "Months until base expiry: ".$this->getMonthsUntilExpiry($testMake, $vehAge)." ||| ";
        echo "Miles until base expiry: ".$this->getMilesUntilExpiry($testMake, $testMiles)." ||| ";
        echo "Vehicle age in months: ".$vehAge."\n";
        $this->testCoverage($testMake, $testYear, $testMiles, $testCoverage);
    } 

    public function testCoverage($make, $year, $mileage, $coverage){
        $failures = [];
        $status = '';
        $suffix = [];
        $vehAge = $this->getVehAge($year); 

        $status = $this->isUsedorNew($mileage, $coverage);

        $suffix[0] = $year['suffix1']; 

        $suffix[1] = $this->getIssueMileageSuffix($mileage);

        if(($mileage + $coverage['miles']) > $this->maxMiles){
            array_push($failures, 'Mileage cannot be more than 153,000, before coverage expires.');
        }

        if(($vehAge + $coverage['terms']) > $this->maxAge){ 
            array_push($failures, 'Age cannot be more than 147 months, before coverage expires.');
        }

        if($this->getMilesUntilExpiry($make, $mileage) > $coverage['miles']){
            array_push($failures, 'Miles expires before remaining warranty miles.');
        }

        if($this->getMonthsUntilExpiry($make, $vehAge) > $coverage['terms']){
            array_push($failures, 'Terms expires before remaining warranty term.');
        }

        $vehStr = "{$make['make']} {$year['modelyear']} {$mileage} {$status} \"{$coverage['name']}\" suffix1:{$suffix[0]} suffix2:{$suffix[1]}";
        if(empty($failures)){
            echo  $vehStr." RESULT: SUCCESS \n";
        } else {
            echo  $vehStr." RESULT: FAILURE ".print_r($failures, true)." \n";
        }
    }

    // Get suffix based on issue mileage
    public function getIssueMileageSuffix($mileage){
        foreach($this->issue_mileage as $key => $value){
            if(($mileage >= $value['min']) && ($mileage <= $value['max'])){
                return $value['suffix2'];
            }
        }
    }

    // Returns positive if there are miles left on base. Negative if already expired.
    public function getMilesUntilExpiry($make, $miles){
        return $make['miles'] - $miles;
    }

    // Returns positive if there are months left on base. Negative if already expired.
    public function getMonthsUntilExpiry($make, $months){
        return $make['term'] - $months;
    }

    // Get vehicle old based on current year. - YEAR x 12 months
    public function getVehAge($year){
        return (date("Y") - $year['modelyear']) * 12; 
    }

    public function isUsedOrNew($mileage, $coverage){
        if($mileage <= $coverage['miles']){ 
            $status = 'NEW';
        }
        else{
            $status = 'USED';
        }
        return $status;
    }

    private function getCoverage(){
        $contents = file_get_contents('coverage.json');
        $array = json_decode($contents, true);
        return $array;
    }

}

?>