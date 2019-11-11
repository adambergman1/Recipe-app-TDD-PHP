<?php

class Measurement
{
    private $measurementList = array('dl', 'kg', 'g', 'cl', 'tbsp', 'tsp', 'ml', 'l', 'hg');
    private $measurement;

    public function __construct(string $measure)
    {
        $this->validateMeasurement($measure);
    }

    private function validateMeasurement(string $measure): void
    {
        if (!in_array($measure, $this->measurementList)) {
            throw new NotAValidMeasurementException();
        } else {
            $this->measurement = $measure;
        }
    }

    public function getMeasurement(): string
    {
        return $this->measurement;
    }
}
