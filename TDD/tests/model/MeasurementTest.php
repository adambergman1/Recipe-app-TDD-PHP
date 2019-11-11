<?php

include_once("../../src/model/Measurement.php");

class MeasurementTest extends PHPUnit\Framework\TestCase
{

    /** @test */
    function shouldAcceptCorrectMeasurement()
    {
        $input = 'dl';
        $sut = new Measurement($input);
        $actual = $sut->getMeasurement();

        $expected = 'dl';

        $this->assertEquals($actual, $expected);
    }

    /** @test */
    function shouldThrowExceptionOnInvalidMeasurement()
    {
        $this->expectException(NotAValidMeasurementException::class);

        $input = 'gallon';
        new Measurement($input);
    }
}
