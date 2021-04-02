# RoadVantage Developer Test

## Requirements

PHP 7.X+, Composer

## Running

On windows please run the application as shown:

php -r "include('VehicleCoverage.php'); new $obj->VehicleCoverage; $obj->testAllVehicles();"

To run it from a script you can use it by initializing the VehicleCoverage object and running the testAllVehicles(); method like so:

include('VehicleCoverage.php'); 
new $obj->VehicleCoverage; 
$obj->testAllVehicles();

(you can also add this code to the bottom of the script and simply run 'php VehicleCoverage.php')

## Other methods

Extra method to run vehicle specific tests can be used as such:

    testVehicle($war, $yr, $cov, $mil)
    $war is the base warranty array key to test
    $yr is the year array key to test
    $cov is the coverage key to test
    $mil is the number of mileage to test


## Running the Unit Test

Please run the phpunit test as such on windows:

    composer install
    "./vendor/bin/phpunit" vehicleTest.php
