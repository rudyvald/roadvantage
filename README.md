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
    
## Original Project Requirements

 * PHP Developer Test 17
 *
 * Test a developers ability to create a class along with supporting methods.
 * Test a developers ability to create unit tests to validate each methods logic.
 *
 * INSTRUCTIONS:
 * --------------------------------------------------------------------
 * Write a class which will validate if a vehicle can carry any of the warranty coverages in the $coverage array
 *
 * Rules:
 * Book of Contracts should not have active contracts on vehicles where the mileage on the vehicle is > 153,000 miles before contract expires.
 * Book of Contracts should not have active contracts on vehicles who's age is more than 12 years old + 3 months (147 months) before contract expires.
 * Contract coverage should not be available if the term and miles of the coverage expire before the base warranty of the vehicle has expired.
 *
 * Test will validate each vehicle make in the $base_warranty array, each model year of the make in the $years array, and every issue mileage
 * between 0 and 150,000 in 1,000 mile increments.
 *
 * Additionally, a "New" or "Used" flag will be assigned to the output based on the vehicle issue mileage where if the issue mileage falls within the
 * base warranty, "New" value is assigned, otherwise a "Used" value is assigned.
 *
 * Output the following: make, model year, issue mileage, New or Used, coverage name, suffix1 (as a 2 digit zero fill left padded number),
 * suffix2 and success/failure, indicating the reason for the failure. Failure message should include all validation failures.
 *
 * Example (for demonstration purposes):
 *  Test Values: make: BMW, model year: 2018, issue mileage: 1000; testing coverage: "3 Months/3,000 Miles"
 *  Example Output: BMW  2018  1000  NEW  "3 Months/3,000 Miles"  suffix1:00  suffix2:A  RESULT: FAILURE array('Term expires before warranty', 'Miles expires before warranty');
 *
 *  Test Values: make: BMW, model year: 2018, issue mileage: 1000; testing coverage: "100 Months/120,000 Miles"
 *  Example Output: BMW  2018  1000  NEW  "100 Months/120,000 Miles"  suffix1:00  suffix2:A  RESULT: SUCCESS
 *
 * Convert the $coverage array to a json file, simulate an API call in a private method to pull the json file to create the coverage array.
 *
 * Make this a self contained script executable from a linux command line.
 *
 * phpunit test should be included as a separate file.
 *
 * Do not use built-in libraries or frameworks.
