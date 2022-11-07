<?php

namespace WeatherKata\interfaces;

use WeatherKata\Weather;

interface WeatherProvider
{
    public function get_weather_by_city_and_time(string &$city, \DateTime $dateTime):?Weather;
}