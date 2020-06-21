<?php

/**
 * 
 */
class WeatherController
{	
	public function getWeather($query){
		//add query parameters
		$url = "http://api.openweathermap.org/data/2.5/weather?".$query ."&appid=fd3b04fdb6e937b113ceba166182996c";

		$contents = file_get_contents($url);

		$object = json_decode($contents, true);

		return $contents;
	}
}