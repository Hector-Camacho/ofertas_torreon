var lat = $("#latitud").text();
var long = $("#longitud").text();
var Ubicacion = $("#Ubicacion").text();

var mapObj= new GMaps({
	el:'#map',
	lat: lat,
    lng: long
});

var m = mapObj.addMarker({
  lat: lat,
  lng: long,
  title: Ubicacion,
  infoWindow: {
    content: '<h4>'+Ubicacion+'</h4>',
    maxWidth: 100
  }
});

$("#TrazarRuta").click(function(){
  GMaps.geolocate({
  success: function(position){
    mapObj.drawRoute({
      origin: [position.coords.latitude, position.coords.longitude],
      destination: [lat, long],
      travelMode: 'driving',
      strokeColor: '#131540',
      strokeOpacity: 0.6,
      strokeWeight: 6
    });
    mapObj.addMarker({
      lat: position.coords.latitude,
      lng: position.coords.longitude,
      title: 'Tu ubicacion actual',
      color:'blue'
    });
  },
  error: function(error) {
    alert('Geolocalizacion fallida: '+error.message);
  },
  not_supported: function() {
    alert("Tu navegador no soporta la geolocalizacion");
  },
  always: function() {
  }
});
  
});