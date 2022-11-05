<?php

namespace WeatherKata\interfaces;

interface WeatherProvider
{
    public function get_weather_by_city(string $city);
}