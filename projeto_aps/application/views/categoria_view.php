
<html>
	<title>SMIP</title>
	<head>

		<link rel="stylesheet" href="http://cdn.leafletjs.com/leaflet-0.7.2/leaflet.css" />
		<script src="http://cdn.leafletjs.com/leaflet-0.7.2/leaflet.js"></script>

		  <link rel="stylesheet" href="//code.jquery.com/ui/1.10.4/themes/smoothness/jquery-ui.css">
		  <script src="//code.jquery.com/jquery-1.9.1.js"></script>
		  <script src="//code.jquery.com/ui/1.10.4/jquery-ui.js"></script>

		<style>
		#map {
		    width:900px;
		    height:550px;
		    }

		    body { font-size: 62.5%; }
		    label, input { display:block; }
		    input.text { margin-bottom:12px; width:95%; padding: .4em; }
		    fieldset { padding:0; border:0; margin-top:25px; }
		    h1 { font-size: 1.2em; margin: .6em 0; }
		    div#users-contain { width: 350px; margin: 20px 0; }
		    div#users-contain table { margin: 1em 0; border-collapse: collapse; width: 100%; }
		    div#users-contain table td, div#users-contain table th { border: 1px solid #eee; padding: .6em 10px; text-align: left; }
		    .ui-dialog .ui-state-error { padding: .3em; }
		    .validateTips { border: 1px solid transparent; padding: 0.3em; }
		</style>
		<script type="text/javascript">
		  	window.onload = function () {
				var map = L.map('map').setView([-15.60877, -56.06379], 17);
		       		 L.tileLayer('http://{s}.tile.osm.org/{z}/{x}/{y}.png', {
		        	attribution: '&copy; <a href="http://osm.org/copyright">OpenStreetMap</a> contributors'
		        	}).addTo(map);

				function evento() {
					var marker1 = L.marker([-15.60877, -56.06379],{title:"marker_2"}).addTo(map).bindPopup("Marker 2");

				};
			
				var popup = L.popup();
				
				/*
				function onMapClick(e) {
				    popup
				        .setLatLng(e.latlng)
				        .setContent("You clicked the map at " + e.latlng.toString() + Date())
				        .openOn(map);
				}*/

				/*
				function onMapClick(e){
				var x;

				var person=prompt("Please enter your name",e.latlng.toString());

				if (person!=null)
				  {
				  x="Hello " + person + "! How are you today?";
				  popup.setLatLng(e.latlng).setContent(x).openOn(map);
				  //document.getElementById("demo").innerHTML=x;
				  }
				}*/

				function onMapClick(e){ //Adiciona Ponto ao clicar no mapa
					    $(function () {     
					    	document.getElementById("lblcoordenada").innerHTML=	e.latlng.toString();
					    	//$("#lblcoordenada").append(e.latlng.toString());       
					        $("#dialog-form").dialog({ 
					        	buttons: [{ 
					        			text: "Adicionar Ponto", click: function() { 
					        				$( this ).dialog( "close" );
					        			//VALIDAR DADOS
					         		}
					    		}]
					    	});

					    });
				}
			
				map.on('click', onMapClick);

				var markers = [];
			    var marker1 = L.marker([-15.60877, -56.06379],{title:"marker_1"}).addTo(map).bindPopup("Marker 1");
			    markers.push(marker1);
			    
			    function markerFunction(id){
			        for (var i in markers){
			            var markerID = markers[i].options.title;
			            if (markerID == id){
			                markers[i].openPopup();
			            };
			        }
			    }
			    
			    $("a").click(function(){
			        markerFunction($(this)[0].id);
			    });



			};
		</script>
	</head>
	<body>
		<div id="map"></div>
		<a id="marker_1" href="#">Marker 1</a>

		<div id="dialog-form" title="Create new user" style="display:none">
		 
		  <form>
		  <fieldset>
		  	<label for="coordenada" id="lblcoordenada"></label>
		    <label for="name">Nome</label>
		    <input type="text" name="name" id="name" class="text ui-widget-content ui-corner-all">
		    <label for="email">Tipo</label>
		    <input type="text" name="email" id="email" value="" class="text ui-widget-content ui-corner-all">
		  </fieldset>
		  </form>
		</div>


	</body>
</html>