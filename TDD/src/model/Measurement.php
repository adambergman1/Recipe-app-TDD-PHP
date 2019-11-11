<?php

class Measurement
{
    private $measurementList = array('dl', 'kg', 'g', 'cl', 'tbsp', 'tsp', 'ml', 'l', 'hg');
    private $measurement;

    public function __construct(string $measure)
    {
        if (!in_array($measure, $this->measurementList)) {
            throw new NotAValidMeasurementException();
        } else {
            $this->measurement = $measure;
        }
    }

    public function getMeasurement()
    {
        return $this->measurement;
    }
}
