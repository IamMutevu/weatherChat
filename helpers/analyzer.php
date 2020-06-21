<?php
require "../controllers/WeatherController.php";

//get message posted by user
$message = $_POST['message'];

analyze($message);


function analyze($message){
	//keywords array
	$keywords = array("city", "zip", "coordinates");

	//convert to lower case
	$message = strtolower($message);

	$found = 0;
	//check if keywords exist in message
	foreach ($keywords as $keyword){
		if(strpos($message, $keyword) !== false){
			$found = 1;
			$foundWord = $keyword;
			break;
		}
	}

	//intialize weather controller object
	$weather = new WeatherController();

	if($found ==1){
		//remove white spaces from string
		$string = str_replace(" ", "", $message);

		if(strrpos($string, "=")!== false){
			//construct queries depending on type of parameters given
			if($foundWord == "city"){
				//get name of city
				$city = substr($string, strpos($string, "=")+1);
				$query = "q=".$city;
				http_response_code(200);
				echo $weather->getWeather($query);
			}
			elseif($foundWord == "zip"){

				//get zip of location
				$zip = substr($string, strpos($string, "=")+1);
				$query = "zip=".$zip;
				http_response_code(200);
				echo $weather->getWeather($query);
			}
			elseif($foundWord == "coordinates"){
				//get coordinates of location
				$coordinates = substr($string, strpos($string, "=")+1);
				$latitude = substr($coordinates, 0, strpos($coordinates, ","));
				$longitude = substr($coordinates, strpos($coordinates, ",")+1);
				$query = "lat=".$latitude ."&lon=" .$longitude;
				http_response_code(200);
				echo $weather->getWeather($query);

			}
		}
		else{
			echo "invalid";
		}

		
	}
	else{
		echo "Normal convo";
	}	
}
