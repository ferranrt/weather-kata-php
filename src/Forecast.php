<?php

namespace WeatherKata;

use DateTime;
use WeatherKata\interfaces\WeatherProvider;

class Forecast
{
    private WeatherProvider $client;

    public function __construct(WeatherProvider $client)
    {
        $this->client = $client;
    }

    public function predict(string &$city, ?DateTime $datetime = null, bool $wind = false): string
    {
        $datetime ??= new DateTime();
        if (!$this->isPredictableDay($datetime)) {
            return "";
        }

        $weather = $this->client->get_weather_by_city_and_time($city,$datetime);

        if(is_null($weather)){
            return '';
        }

        if ($wind) {
            return $weather->getWindSpeed();
        }
        return $weather->getWeatherState();
    }

    private function isPredictableDay(DateTime $datetime): bool
    {
        return $datetime < new DateTime("+6 days 00:00:00");
    }
}
