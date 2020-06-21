$(document).ready(function(){
	var salutation = ["Hello", "Hi", "Greetings"];

	var randomGreeting = salutation[Math.floor(Math.random() * salutation.length)];

	//append random greetings to the chatbox
	$("#chatBox").append(
		`
		<div class="bubble-right">${randomGreeting}</div>
		`
		);

	$("form").submit(function(e){
		e.preventDefault();

		//pick value typed by user
		var message = $("#message").val();

		//reset input field after form submission
		(this).reset();
		$("#chatBox").append(
		`
		<div class="bubble-left">${message}</div>
		`
		);

		//check if user asks for help
		var helpTest = message.toLowerCase();

		if(helpTest == "help"){
			//
			$("#chatBox").append(
			`
			<div class="bubble-right">
				You can get the weather updates of any place using the name of the city, the coordinates, or the zip code.<br>
				Examples:<br>
				city=Nairobi<br>
				zip=94040,us<br>
				coordinates=37.39,-122.09

			</div>
			`
			);			
		}
		else{
			//send ajax request with user message
			$.post("./helpers/analyzer.php", 
			{
				"message": message
			},
			function(data, status){
				if(data != "invalid"){
					var json = JSON.parse(data);
					if(json.name){
						$("#chatBox").append(
						`
						<div class="bubble-right">
							<p>Name: ${json.name}</p>
							<p>Longitude: ${json.coord.lon}</p>
							<p>Latitude: ${json.coord.lat}</p>
							<p>Weather: ${json.weather[0].main}</p>
							<p>Temperature: ${json.main.temp}</p>
							<p>Humidity: ${json.main.humidity}</p>
							<p>Pressure: ${json.main.pressure}</p>
							<p>Wind speed: ${json.wind.speed}</p>


						</div>
						`
						);						
					}
					else{
						$("#chatBox").append(
						`
						<div class="bubble-right">
						${json.response}
						</div>
						`
						);
					}
	
				}
				else{
					$("#chatBox").append(
					`
					<div class="bubble-right">I cannot resolve the location. Please type help to get suggestions</div>
					`
					);	
				}
				
				

			}
			);			
		}



	});
});