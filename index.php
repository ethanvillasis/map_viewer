 <!DOCTYPE html>
<html>
<head>
	
	<title>Map Viewer</title>
</head>
<body>

<div>
	<?php


	if (isset($_POST['submit'])){
		$loc = $_POST['lat'] . "," . $_POST['long'];
		$loc =explode(",", $loc);
	}else{
		$ip = "110.54.181.202";	//own IP
		
		$details = json_decode(file_get_contents("http://ipinfo.io/{$ip}/json"));
		// var_dump($details);

		$loc =explode(",", $details->loc);
	}
	?>

</div>

<div id="googleMap" style="width:100%;height:400px;"></div>

<div>
	<form method="POST" >
		<h3>Add a Pin</h3>
		<p>
			
			<label>Lat:&nbsp;</label><input type="text" name="lat" value="<?=$loc[0];?>" />&nbsp;&nbsp;
			<label>Long:&nbsp;</label><input type="text" name="long" value="<?=$loc[1];?>" />&nbsp;&nbsp;
			<input type="submit" name="submit" value="Submit" />
		</p>
	</form>
</div>

<script>

	
	function myMap() {

		var lat=<?=$loc[0];?>;
		var long=<?=$loc[1];?>;
		const myLatLng = { lat: lat, lng: long };

		var mapProp= {
		  //center:new google.maps.LatLng(51.508742,-0.120850),
		  center:new google.maps.LatLng(lat,long),
		  zoom:5,
		  mapTypeId: 'roadmap'

		};	

		var map = new google.maps.Map(document.getElementById("googleMap"),mapProp);


		//add marker or pin
		new google.maps.Marker({
		    position: myLatLng,
		    map,
		    title: "Hello World!",
		});
	}
</script>

<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAHb53GSMEP4SVIzNlNcrGAlYCQgqblY78&callback=myMap"></script>

</body>
</html> 