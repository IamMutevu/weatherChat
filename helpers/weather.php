<?php

$message = $_POST['message'];

if($message){

	$url = "http://api.openweathermap.org/data/2.5/weather?appid=fd3b04fdb6e937b113ceba166182996c&q=".$message;

	$contents = file_get_contents($url);

	$object = json_decode($contents, true);
	echo $object["weather"][0]['main'];

}
else{
	echo "Nothing";
}