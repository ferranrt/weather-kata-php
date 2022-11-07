<?php

namespace WeatherKata\interfaces;

use WeatherKata\Weather;

interface WeatherProvider
{
    public function get_weather_by_city_id_and_time(string $city_id, \DateTime $dateTime):?Weather;
    public function get_city_id(string $city):string;
}