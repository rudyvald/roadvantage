<?php
require('vendor/autoload.php');
require('VehicleCoverage.php');

use PHPUnit\Framework\TestCase;

class VehicleTest extends TestCase
{
    public function testIssueMileageSuffix(){
        $obj = new VehicleCoverage();
        $this->assertTrue($obj->getIssueMileageSuffix(25000) === 'B');
    } 

    public function testMilesUntilExpiry(){
        $obj = new VehicleCoverage();
        $this->assertTrue($obj->getMilesUntilExpiry(array("miles" => 24000), 5000) === 19000);
    } 

    public function testMonthsUntilExpiry(){
        $obj = new VehicleCoverage();
        $this->assertTrue($obj->getMonthsUntilExpiry(array("term" => 24), 20) === 4);
    } 

    public function testVehAge(){
        $obj = new VehicleCoverage();
        $yrs = (date("Y") - 2018) * 12;
        $this->assertTrue($obj->getVehAge(array("modelyear" => 2018)) === $yrs);
    } 

    public function testUsedOrNew(){
        $obj = new VehicleCoverage();
        $this->assertTrue($obj->isUsedOrNew(1000, array("miles" => 24000)) === 'NEW');
    } 
}
?>