<?php

class MeasurementTest extends PHPUnit\Framework\TestCase
{

    /** @test */
    function shouldAcceptCorrectMeasurement()
    {
        $input = 'dl';
        $sut = new Measurement($input);
        $actual = $sut->getMeasurement();

        $expected = 'dl';

        assertEquals($actual, $expected);
    }
}
