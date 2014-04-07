<html>
<head>
	<title>Local Weather</title>
	<link rel="stylesheet" type="text/css" href="/assets/css/weather.css">
	<script type="text/javascript" src="http://code.jquery.com/jquery-1.10.2.min.js"></script>
	<script type="text/javascript">
	$(document).ready(function(){
		$('form').submit(function(){
			$.get($(this).attr('action')+"?callback=?",
			$(this).serialize(),
			function(weather){
				console.log(weather);
				var place = weather.data.request[0].query;
				var placetype = weather.data.request[0].type;
				var tempF = weather.data.current_condition[0].temp_F;
				var tempC = weather.data.current_condition[0].temp_C;
				var windspeed = weather.data.current_condition[0].windspeedMiles;
				var windDir = weather.data.current_condition[0].winddir16Point;
				var conditions = weather.data.current_condition[0].weatherDesc[0].value;
				var weatherDesc = weather.data.weather[0].weatherDesc[0].value;
				var daily = $.each(weather.data.weather, function( key, value ) {
					})
				$('#forecast').append(
						"<h2>Weather for the "+placetype+" "+place+"</h2>"+
						"<p>Current Temp F: "+tempF+"</p>"+
						"<p>Current Temp C: "+tempC+"</p>"+
						"<p>Current Windspeed: "+windspeed+"mph "+windDir+"</p>"+
						"<p>Conditions: "+conditions+" and "+weatherDesc+"</p>"+
						"<a href=''>Click here for 5 day forecast</a>"+
						"<div class='days' style='display:none'>"+
							"<table class='table_forecast'>"+
								"<th>"+daily[0]['date']+"</th>"+
								"<th>"+daily[1]['date']+"</th>"+
								"<th>"+daily[2]['date']+"</th>"+
								"<th>"+daily[3]['date']+"</th>"+
								"<th>"+daily[4]['date']+"</th>"+
								"<tr>"+
									"<td><img src="+daily[0]['weatherIconUrl'][0]['value']+"></td>"+
									"<td><img src="+daily[1]['weatherIconUrl'][0]['value']+"></td>"+
									"<td><img src="+daily[2]['weatherIconUrl'][0]['value']+"></td>"+
									"<td><img src="+daily[3]['weatherIconUrl'][0]['value']+"></td>"+
									"<td><img src="+daily[4]['weatherIconUrl'][0]['value']+"></td>"+
								"</tr>"+
								"<tr>"+
									"<td>"+daily[0]['weatherDesc'][0]['value']+"</td>"+
									"<td>"+daily[1]['weatherDesc'][0]['value']+"</td>"+
									"<td>"+daily[2]['weatherDesc'][0]['value']+"</td>"+
									"<td>"+daily[3]['weatherDesc'][0]['value']+"</td>"+
									"<td>"+daily[4]['weatherDesc'][0]['value']+"</td>"+
								"</tr>"+
							"</table>"+
						"</div>");
			}, 'json');
			return false;
		});
		$(document).on('click', 'a', function(){
			$(this).siblings().slideDown();
			return false;
		})
	});

	</script>
</head>
<body>
	<div id='form'>
		<h1>Weather!!!!!!!!</h1>
		<form action = 'http://api.worldweatheronline.com/free/v1/weather.ashx' method='get'>
			<label for='zipcode'>Enter your location: </label>
			<input type='text' name='q' placeholder='Location'>
			<input type='hidden' name='key' value='jtpc4myth9fwxjgwz9fh5fw5'>
			<input type='hidden' name='format' value='json'>
			<input type='hidden' name='num_of_days' value='5'>
			<input type='submit' value='Get Weather'>
		</form>
	</div>
	<div id='forecast'>
		<h2>Your Forecast</h2>
		<div id='fiveday'>
		</div>
	</div>
	
</body>
</html>