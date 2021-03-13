<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
  <script src="https://maps.googleapis.com/maps/api/js?v=4&sensor=false&libraries=geometry"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.3/jquery.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.4.8/angular.min.js"></script>
	<script type="text/javascript">
		
		var geocoder = new google.maps.Geocoder();
var map;
var infowindow = new google.maps.InfoWindow();
var marker = new google.maps.Marker();
 
function closeInfoWindow() {
        infowindow.close();
   }
 
function initialize2() {
  geocoder = new google.maps.Geocoder();
  var latlng = new google.maps.LatLng(20.68009, -101.35403);
  var mapOptions = {
    zoom: 8,
    center: latlng,
    mapTypeId: 'roadmap'
  }
  map = new google.maps.Map(document.getElementById('map_canvas'), mapOptions);
 
  google.maps.event.addListener(map, 'click', function(){
            closeInfoWindow();
          });
}
 
function codeLatLng(lat0,lon0) {
  //var input = document.getElementById('latlng'+id).value;
  var input = lat0+","+lon0;
  var latlngStr = input.split(',', 2);
  var lat = parseFloat(latlngStr[0]);
  var lng = parseFloat(latlngStr[1]);
  var latlng = new google.maps.LatLng(lat, lng);
  geocoder.geocode({'latLng': latlng}, function(results, status) {
    if (status == google.maps.GeocoderStatus.OK) {
      if (results[0]) {
        map.fitBounds(results[0].geometry.viewport);
                marker.setMap(map);
                marker.setPosition(latlng);
        document.getElementById('address').innerHTML=(results[0].formatted_address);
        infowindow.setContent(results[0].formatted_address);
        infowindow.open(map, marker);
        google.maps.event.addListener(marker, 'click', function(){
            infowindow.setContent(results[0].formatted_address);
            infowindow.open(map, marker);
        });
      } else {
        //alert('No results found');
      }
    } else {
      //alert('Geocoder failed due to: ' + status);
    }
  });
}
 

	</script>
</head>
<body>

<div id="map_canvas" style="width: 0px; height: 0px; display: none;"></div>
<script type="text/javascript">
	
   initialize2();
</script>
</body>
</html>