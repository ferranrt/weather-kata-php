<?php

namespace WeatherKata\providers;

use WeatherKata\interfaces\WeatherProvider;
use WeatherKata\services\HttpClient;
use WeatherKata\Weather;


class MetaweatherWeatherProvider implements WeatherProvider
{
    private HttpClient $client;

    public function __construct(HttpClient $client)
    {
        $this->client = $client;
    }

    public function get_weather_by_city_id_and_time(string $city_id, \DateTime $datetime): ?Weather
    {
        $results = $this->client->get("https://www.metaweather.com/api/location/$city_id");

        foreach ($results as $result) {
            if ($result["applicable_date"] == $datetime->format('Y-m-d')) {
                return new Weather($result['wind_speed'], $result['weather_state_name']);
            }
        }
        return null;

    }


    public function get_city_id(string $city): string
    {
        return $this->client->get("https://www.metaweather.com/api/location/search/?query=$city");
    }
}