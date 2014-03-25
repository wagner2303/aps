<html>
	<title>SMIP</title>
	<head>

		<link rel="stylesheet" href="http://cdn.leafletjs.com/leaflet-0.7.2/leaflet.css" />
		<script src="http://cdn.leafletjs.com/leaflet-0.7.2/leaflet.js"></script>

		  <link rel="stylesheet" href="//code.jquery.com/ui/1.10.4/themes/smoothness/jquery-ui.css">
		  <script src="//code.jquery.com/jquery-1.9.1.js"></script>
		  <script src="//code.jquery.com/ui/1.10.4/jquery-ui.js"></script>

		<style>
			html,body, #map {
				position: relative;
			    height:100%;
			    padding: 0px;
			    margin: 0px;
			    }
			#map{
				width:80%;
				cursor:default;
			}
			#selecao{
				width:20%;
				margin-left:80%;
			}

		    body { font-size: 80%;}
		    label, input { font-size: 80%; }
		    input.text { margin-bottom:12px; width:95%; padding: .4em; }
		    h1 { font-size: 1.2em; margin: .6em 0; }
		    .ui-dialog .ui-state-error { padding: .3em; }
		</style>
		<script type="text/javascript">
		  	window.onload = function () {
		  		var listaSelecao = ['Bloco','Lanchonete'];

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
						var nome = $("#name");
					    $(function () {     
					    	document.getElementById("lblcoordenada").innerHTML=	e.latlng.toString();
					    	//$("#lblcoordenada").append(e.latlng.toString());       
					        $("#dialog-form").dialog({ 
					        	buttons: [{ 
					        			text: "Adicionar Ponto", click: function() { 
					        				var ponto = L.marker([e.latlng.lat, e.latlng.lng],{title:nome.val()}).addTo(map).bindPopup(nome.val());
					        				//nome.val("").removeClass( "ui-state-error" );
					        				$( this ).dialog( "close" );
					        			//VALIDAR DADOS
					         		}
					    		}],
					    		close: function() {
					    			nome.val("").removeClass( "ui-state-error" );
					    		}
					    	});

					    });
				}
			
				map.on('click', onMapClick);

				var markers = [];
			    var marker1 = L.marker([-15.60877, -56.06379],{title:"marker_1"}).addTo(map).bindPopup("Marker 1");
			    markers.push(marker1);
			    var ponto = L.marker([-15.60832, -56.06286],{title:"Lanchonetes"}).addTo(map).bindPopup("Lanchonete KyloByte");
			    markers.push(ponto);

			    //var lanchonetes = L.layerGroup([ponto]);
			    ponto = L.marker([-15.60907, -56.0628],{title:"Lanchonetes"}).addTo(map).bindPopup("Lanchonete Enfermagem");
			    markers.push(ponto);
			    //lanchonetes.addLayer(ponto);

				//var overlayMaps = {
				//    "Lanchonetes": lanchonetes
				//};

			    //L.control.layers(null,lanchonetes).addTo(map);
			    
			    function markerFunction(id){
			        for (var i in markers){
			            var markerID = markers[i].options.title;
			            if (markerID == id){
			                markers[i].openPopup();
			            };
			        }
			    }

			    function novaCategoria() {
					    $(function () {     
					        $("#categoria-form").dialog({ 
					        	buttons: [{ 
					        			text: "Adicionar Categoria", click: function() { 
					        				$( this ).dialog( "close" );
					        			//VALIDAR DADOS
					         		}
					    		}],
					    		close: function() {
					    			//nome.val("").removeClass( "ui-state-error" );
					    		}
					    	});

					    });
				}

			    function seleciona(){
			    	var id = document.menuForm.selecaoTipo.options[document.menuForm.selecaoTipo.selectedIndex].value;  


			        for (var i in markers){
			            var markerID = markers[i].options.title;
			            if (markerID == id){
			                markers[i].openPopup();
			            };
			        }
			    }
			    
			    $("select").click(function(){
			        markerFunction($(this)[0].value);
			    });
				

				//FUNCOES ADICIONA NOVA CATEGORIA
				function removeCampo() { 
					$(".removerCampo").unbind("click"); 
					$(".removerCampo").bind("click", function () { 
						i=0; 
						$(".addCategoria p.campoCategoria").each(function () { 
							i++; 
						}); 
						if (i>1) { 
							$(this).parent().remove(); 
						} 
					}); 
				} 
				removeCampo(); 
				$(".adicionarCampo").click(function () { 
					novoCampo = $(".addCategoria p.campoCategoria:first").clone(); 
					novoCampo.find("input").val(""); 
					novoCampo.insertAfter(".addCategoria p.campoCategoria:last"); 
					removeCampo(); 
				});

				//PREVENIR DE ENVIAR FORM SE APERTAR ENTER
				$(document).ready(function() {
					$(window).keydown(function(event){
				    if(event.keyCode == 13) {
				      event.preventDefault();
				      return false;
				    }
				  });
				});

			};
		</script>
	</head>
	<body>

		<!--	<div id="map"></div> -->

		
		<table style="width:100%;height:100%">
			<tr>
				<td id="map"></td>
				<td style= "width:20%">
					<div id="categoria-form" title="Criar nova categoria">
					 	<form method="post" action="categoria/cadastrar" enctype="multipart/form-data">
					 		<h1>CRIAR NOVA CATEGORIA</h1>
						    <label for="name">Nome</label>
						    <input type="text" name="nomeCategoria" id="nomeCategoria" class="text ui-widget-content ui-corner-all">

						    <div class="addCategoria">
						    	<p class="campoCategoria">
						    		<label>Campo:</label>
						    		<input type="text" name="nomeCampo[]" style="width:30%" />
									<select id="tipoCampo" name="tipoCampo">
										    <option value="1">Data</option>
						    			    <option value="2">Inteiro</option>
											<option value="3">String</option>
										    <option value="4">Real</option>
									</select>
						    		<a href="#" class="removerCampo">Remover</a>
						    	</p>
						    </div>
						    <a href="#" class="adicionarCampo">Adicionar Campo</a>
						    <input type="submit" value="Salvar"/>

						</form>
					</div>
				</td>
				<!--
				<td id="selecao" style="position:absolute; left:0px;top:0px">
					<select id="selecaoTipo" onchange="seleciona()" name="selecaoTipo">
						    <option value="Blocos">Blocos</option>
		    			    <option value="Lanchonetes">Lanchonetes</option>
					</select>
				</td>
				-->
			</tr>
		</table>
		<!--<a id="marker_1" href="#">Marker 1</a>-->

		<div id="dialog-form" title="Create new user" style="display:none">
		 	<form>
			  	<label for="coordenada" id="lblcoordenada"></label>
			    <label for="name">Nome</label>
			    <input type="text" name="name" id="name" class="text ui-widget-content ui-corner-all">
				<select id="selecaoTipo" name="selecaoTipo">
					    <option value="Blocos">Blocos</option>
	    			    <option value="Lanchonetes">Lanchonetes</option>
				</select>
			</form>
		</div>

		<!--
		<button onclick="novaCategoria()">Nova Categoria</button>

		<div id="categoria-form" title="Criar nova categoria" style="display:none">
		 	<form>
			    <label for="name">Nome</label>
			    <input type="text" name="name" id="name" class="text ui-widget-content ui-corner-all">

			    <div class="addCategoria">
			    	<p class="campoCategoria">
			    		<input type="text" name="campo[]" />
			    		<a href="#" class="removerCampo">Remover Campo</a>
			    	</p>
			    </div>
			    <p>
			    	<a href="#" class="adicionarCampo">Adicionar Campo</a>
			</form>
		</div>
		-->

	</body>
</html>
<!--
<html>
	<title>teste</title>
	<head>
	</head>
	<body>
		  <form method="post" action="categoria/cadastrar" enctype="multipart/form-data">
		    <label for="name">Nome</label>
		    <input type="text" name="nomeCategoria" id="nomeCategoria" >
                    <input type="submit" value="Próximo"/>
		  </form>
	</body>
</html>
-->