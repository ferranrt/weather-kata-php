<?php

namespace WeatherKata;

use WeatherKata\Http\Client;

class Forecast
{
    private $client;

    public function __construct(Client $client) {
        $this->client = $client;
    }
    
    public function predict(string &$city, \DateTime $datetime = null, bool $wind = false): string
    {
        if ($datetime == null) {
            $datetime = new \DateTime();
        }

        // If there are predictions
        if ($datetime >= new \DateTime("+6 days 00:00:00")) {
           return "";
        } 

        // Todo abstract
        // Find the id of the city on metawheather
        $city_id = $this->client->get("https://www.metaweather.com/api/location/search/?query=$city");
        $city = $city_id;

        // Find the predictions for the city
        $results = $this->client->get("https://www.metaweather.com/api/location/$city_id");


        // TODO serializer
        foreach ($results as $result) {
            // When the date is the expected
            if ($result["applicable_date"] == $datetime->format('Y-m-d')) {
                // If we have to return the wind information
                if ($wind) {
                    return $result['wind_speed'];
                }
                return $result['weather_state_name'];
            }
        }
    }
}