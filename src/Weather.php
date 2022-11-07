<?php

namespace WeatherKata;

class Weather
{
    public function __construct(float $windSpeed, String $weather_state)
    {
        $this->weather_state = $weather_state;
        $this->windSpeed = $windSpeed;
    }

    private float $windSpeed;
    private string $weather_state;


    public function getWeatherState(): string
    {
        return $this->weather_state;
    }

    public function getWindSpeed(): float
    {
        return $this->windSpeed;
    }
}