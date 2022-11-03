<?php

namespace WeatherKata;
use WeatherClient;

class Forecast
{
    private $client;

    public function __construct(WeatherClient $client) {
        $this->client = $client;
    }
    
    public function predict(string &$city, \DateTime $datetime = null, bool $wind = false): string
    {
        $datetime ??= new \DateTime();

        // If there are predictions
        
        if (! $this->isPredictableDay($datetime)) {
           return "";
        } 

        ////// Todo abstract ////// WeatherClient
        // Find the woeid of the city on metawheather
        $this->client->get_weather_by_city($city);
        ////////////////////////

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

    private function isPredictableDay(\DateTime $datetime){
        return $datetime < new \DateTime("+6 days 00:00:00");
    }
}