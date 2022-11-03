<?php

namespace WeatherKata;

use WeatherKata\Http\Client;

class WeatherClient
{   
    private $client;
    
    public function __construct(Client $client) {
        $this->client = $client;
    }

    public function get_weather_by_city(string $city): array {
        $city_id = $this->client->get("https://www.metaweather.com/api/location/search/?query=$city");

        // Find the predictions for the city
        return $this->client->get("https://www.metaweather.com/api/location/$city_id");
    }
}