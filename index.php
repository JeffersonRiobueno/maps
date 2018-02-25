<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Mapas</title>
	<link rel="stylesheet" href="css/maps.css">
</head>
<body>
	<div id="mapa"></div>
	<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAHzPSV2jshbjI8fqnC_C4L08ffnj5EN3A"></script>
<script>
	//GET
	//<?php //	$json = json_encode($post_page);?>
	//lista_hotel=<?php //echo $json; ?>;
	var marcadores = [];

function mapaGoogle() {
  //manual
  var localidades = [
    ['León', 42.603, -5.577],
    ['Salamanca', 40.963, -5.669],
    ['Zamora', 41.503, -5.744]
  ];
  //GET
  /*
	var localidades = [];
	for (var i = 0 ; i < lista_hotel.Post["titulo"].length; i++) {

		localidades[i] = [lista_hotel.Post['titulo'][i],lista_hotel.Post['x'][i],lista_hotel.Post['y'][i]];

	}
  */
  var mapa = new google.maps.Map(document.getElementById('mapa'), {
    zoom: 7,
    mapTypeId: google.maps.MapTypeId.ROADMAP
  });
  
  var limites = new google.maps.LatLngBounds();
  
  var infowindow = new google.maps.InfoWindow();
  
  var marcador, i;
  
  for (i = 0; i < localidades.length; i++) {
    
    marcador = new google.maps.Marker({
      position: new google.maps.LatLng(localidades[i][1], localidades[i][2]),
      map: mapa
    });
    
    marcadores.push(marcador);
    
    limites.extend(marcador.position);
    
    google.maps.event.addListener(marcador, 'click', (function(marcador, i) {
      return function() {
        infowindow.setContent(localidades[i][0]);
        infowindow.open(mapa, marcador);
      }
    })(marcador, i));
  }
  
  mapa.fitBounds(limites);
  
}

google.maps.event.addDomListener(window, 'load', mapaGoogle);


</script>
</body>
</html>