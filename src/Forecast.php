<?php

namespace WeatherKata;
use WeatherKata\interfaces\WeatherProvider;

class Forecast
{
    private WeatherProvider $client;

    public function __construct(WeatherProvider $client) {
        $this->client = $client;
    }
    
    public function predict(string &$city, \DateTime $datetime = null, bool $wind = false): string {
        $datetime ??= new \DateTime();

        if (! $this->isPredictableDay($datetime)) {
           return "";
        } 

       $results =  $this->client->get_weather_by_city($city);

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
        return "";
    }

    private function isPredictableDay(\DateTime $datetime):bool{
        return $datetime < new \DateTime("+6 days 00:00:00");
    }
}