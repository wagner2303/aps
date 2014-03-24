<html>
	<title>SMIP</title>
	<head>
		<link rel="stylesheet" href="leaflet/leaflet.css" />

		<script type="text/javascript" src="leaflet/leaflet.js"></script>

		<style>
		#map {
		    width:900px;
		    height:550px;
		}
		</style>
		<script type="text/javascript">
		  	window.onload = function () {
				var map = L.map('map').setView([-15.60877, -56.06379], 17);
		       		 L.tileLayer('http://{s}.tile.osm.org/{z}/{x}/{y}.png', {
		        	attribution: '&copy; <a href="http://osm.org/copyright">OpenStreetMap</a> contributors'
		        	}).addTo(map);

				function evento() {
					var popup = L.popup()
			 	   .setLatLng([-15.60877, -56.06379])
			 	   .setContent("UFMT")
			 	   .openOn(map);
				};
			
				var popup = L.popup();
				
				function onMapClick(e) {
				    popup
				        .setLatLng(e.latlng)
				        .setContent("You clicked the map at " + e.latlng.toString())
				        .openOn(map);
				}
			
				map.on('click', onMapClick);
				evento();

			};
		</script>
	</head>
	<body>
		<div id="map"></div>
		<button onclick="evento();">Click</button>
	</body>
</html>