<?php
//get public ip
$file = file_get_contents('http://ip6.me/');
$pos = strpos( $file, '+3' ) + 3;
$ip = substr( $file, $pos, strlen( $file ) );

// Trim IP based on HTML formatting
$pos = strpos( $ip, '</' );
$ip = substr( $ip, 0, $pos );

//get latlng
$details = json_decode(file_get_contents("http://ipinfo.io/{$ip}/json"));  
$loc =explode(",", $details->loc);

?>

<!DOCTYPE html>
<html>
  <head>
    <title>Double click on the map</title>
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no">
    <meta charset="utf-8">
    <style>
      html, body, #map-canvas {
        height: 500px;
        margin: 0px;
        padding: 0px
      }

    </style>
   

    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAHb53GSMEP4SVIzNlNcrGAlYCQgqblY78&callback=initialize"></script>

    <script>
      var map;

    function initialize() {
      var my_position = new google.maps.LatLng(<?=$loc[0]?>, <?=$loc[1]?>);
      map = new google.maps.Map(document.getElementById('googleMap'), {
        center: my_position,
        disableDoubleClickZoom: true,
        zoom: 5
      });
      var marker = new google.maps.Marker({
        position: my_position,
        map: map
      });
      
      google.maps.event.addListener(map, 'click', function(e) {
        // var positionDoubleclick = e.latLng;
        // var new_marker = new  google.maps.Marker.setPosition(positionDoubleclick);
        

        var marker = new google.maps.Marker({
            position: e.latLng,
            map: map
          });
      });



     

    }


   



    google.maps.event.addDomListener(window, 'load', initialize);
    </script>
  </head>
  <body>
    
<div id="googleMap" style="width:100%;height:400px;"></div>
<div>
  <!-- <form method="POST" > -->
    <h3>Add a Pin</h3>
    <p>
      
      <label>Lat:&nbsp;</label><input type="text" id="lat" value=<?=$loc[0];?> />&nbsp;&nbsp;
      <label>Long:&nbsp;</label><input type="text" id="lng" value=<?=$loc[1];?> />&nbsp;&nbsp;
      <input type="button" name="submit" id="submit" value="Set" />
    </p>
  <!-- </form> -->
</div>


<script
        src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4="
        crossorigin="anonymous"></script>


<script type="text/javascript">
  

  $( "#submit" ).click(function() {
    console.log('here');
    var lat=  parseFloat( $("#lat").val());
    var lng=  parseFloat( $("#lng").val());
    var myLatLng = { lat: lat, lng: lng };
    console.log(myLatLng);



      var marker = new google.maps.Marker({
            position: myLatLng,
            map: map
          });
      
  });
</script>
  </body>

  </html>
