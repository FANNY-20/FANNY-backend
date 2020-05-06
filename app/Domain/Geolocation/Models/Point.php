<?php

namespace Domain\Geolocation\Models;

class Point
{
    public float $latitude;

    public float $longitude;

    public function __construct(float $lat, float $lon)
    {
        $this->latitude = $lat;
        $this->longitude = $lon;
    }

    /**
     * @return array<float>
     */
    public function toArray(): array
    {
        return [
            $this->longitude,
            $this->latitude,
        ];
    }

    public function __toString(): string
    {
        return "{$this->latitude} {$this->longitude}";
    }
}
