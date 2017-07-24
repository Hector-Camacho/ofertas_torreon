var InformacionVenta={
  		Correo:[],
  		Pago:[]
  	};
  	var Correo={
  		Comprador:"",
  		Vendedor:"",
  		Articulo:"",
  		Precio:"",
  		Direccion:"",
  		Cantidad:"",
  		Precio:"",
  		Entrega:"",
  		Distancia:""
  	};
	$("#buton").click(function(){
		$("#DatosEnvio").modal('toggle');
		localizame();
	});
	 var radianes = function(x) {
						  return x * Math.PI / 180;
						};

	var harvesine = function(p1lat,p1long, p2lat,p2long) {
	  var R = 6378137; // Radio de la tierra en metros
	  var dLat = radianes(p2lat - p1lat);
	  var dLong = radianes(p2long - p1long);
	  var a = Math.sin(dLat / 2) * Math.sin(dLat / 2) +
	    Math.cos(radianes(p1lat)) * Math.cos(radianes(p2lat)) *
	    Math.sin(dLong / 2) * Math.sin(dLong / 2);
	  var c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1 - a));
	  var d = R * c;
	  return d; // regresa la distancia en metros
	};
	var markerArray=[];

	
		function localizame(){
		GMaps.geolocate({
			  success: function(position){
				$.ajax({
       		url: 'https://maps.googleapis.com/maps/api/geocode/json?latlng='+position.coords.latitude+','+position.coords.longitude+'&sensor=true',
       		type: 'GET',
       		success: function (result) {
       			var address = result.results[0].formatted_address;
       			$("#Entrega").val(address);
       		}
       	});
				var mapObj= new GMaps({
					el:'#map',
					lat: position.coords.latitude,
				    lng: position.coords.longitude,
				    zoom:15
				});
				mapObj.addMarker({
					lat: position.coords.latitude,
				  lng: position.coords.longitude,
				  title: 'Aqui estas tu'
				});
				mapObj.addListener('click', function(e) {
				    var longitud=e.latLng.lng();
				    var latitud=e.latLng.lat();
				       if(mapObj.markers.length>1){
				            mapObj.removeMarkers();
				            mapObj.addMarker({
				              lat: position.coords.latitude,
				              lng: position.coords.longitude,
				            });
				            var m = mapObj.addMarker({
				              lat: latitud,
				              lng: longitud,
				            });
				        }
				        else{
				            var m = mapObj.addMarker({
				              lat: latitud,
				              lng: longitud,
				            });
				        }
				         
				        $.ajax({
				           		url: 'https://maps.googleapis.com/maps/api/geocode/json?latlng='+latitud+','+longitud+'&sensor=true',
				           		type: 'GET',
				           		success: function (result) {
				           			var address = result.results[0].formatted_address;
				           			$("#Direccion").val(address);
				           		}
				           	});
				        var banderazo=25;
				        var distancia = harvesine(position.coords.latitude,position.coords.longitude,latitud,longitud)
				        var tot = distancia / 1000;
				        var distancia = tot.toFixed(3);
				        var medida = "";
				        var total = Math.floor(banderazo)+Math.floor((distancia * 2));
				        if(distancia<1)
				        {
				        	distancia = distancia%1;
				        	var distanciastr = String(distancia);
				        	distanciastr.replace('.0','');
				        	medida = distancia +' metros';
				        }
				        else
				        {
				        	distancia=Math.floor(distancia);
				        	medida = distancia+' kilometros';	
				        }
				        $("#Distancia").text(medida);
				        $("#Precio").text('$'+total.toFixed(2));
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
};//Fin de la funcion localizame
	function Vender(){
    	 jQuery.ajax({
		 		url: '/MisPublicaciones/VenderArticulo',
		 		type: 'POST',
		 		dataType: 'HTML',
		 		data: { id: $("input[name=Articuloid]").val()},
		 		success: function (response) {
		 			document.getElementById('tablon').innerHTML = response;
		 			$('#DatosEnvio').modal('toggle');
		 		},
		 		error: function (a,b,c) {}
	 		})
    };
    Conekta.setPublishableKey('key_O_6uGWU1xhMwzgzD');
	var confirmacion;
	$("#venderYa").click(function(){
		confirmacion=$('input[name=radio]:checked', '#FormRadios').val()
		if(confirmacion!="si"){
			Vender();
		}
		else{
			$("#modalVenderPublicacion").modal('toggle');
			$("#DatosEnvio").modal('toggle');
			localizame();
		}
	});
	 $("#DatosEnvioCompletado").click(function(){
		  	Correo.Comprador=$("#Comprador").val();
		  	Correo.Vendedor =$("#Vendedor").val();
		  	Correo.Articulo=$("#Articulo").val();
		  	Correo.Precio=$("#Precio").val();
		  	Correo.Direccion=$("#Direccion").val();
		  	Correo.Entrega=$("#Entrega").val();
		  	Correo.Cantidad=$("#Cantidad").val();
		  	Correo.Precio=$("#Precio").text();
		  	Correo.Distancia=$("#Distancia").text();
		  	InformacionVenta.Correo.push(Correo);
		  	$("#Promocion").modal('toggle');
		  	$("#DatosEnvio").modal('toggle');
	  	});
	$("#PagoTarjetaButton").click(function(){
	    var $form = $("#PagoTarjeta");
	    $form.find('button').prop("disabled",true);
        Conekta.token.create($form, conektaSuccessResponseHandler);
   		return false;
	});
	var conektaSuccessResponseHandler;
	 conektaSuccessResponseHandler = function(token) {
	 	  var Vendedor={
		 		Nombre:"",
		 		Apellido_pat:"",
		 		Apellido_mat:"",
		 		Telefono:"",
		 		Colonia:"",
		 		Calle:"",
		 		Ciudad:"",
		 		Estado:"",
		 		CP:""
		  };
		  Vendedor.Nombre=$("input[name=NombreCon]").val();
		  Vendedor.Colonia=$("input[name=ColoniaCon]").val();
		  Vendedor.Calle=$("input[name=CalleCon]").val();
		  Vendedor.Ciudad=$("input[name=CiudadCon]").val();
		  Vendedor.Estado=$("input[name=EstadoCon]").val();
		  Vendedor.CP=$("input[name=CodigoPostalCon]").val();
		  Vendedor.Calle=$("input[name=CalleCon]").val();
		  var CostEnv = $("#Precio").text();
		  var Cost=CostEnv.replace('$','');
		  var Cost=Cost.replace('.','');
		  Vendedor.CostEnv=Cost;
		  var $form = $("#PagoTarjeta");
		  $form.append($("<input type='hidden' name='conektaTokenId'>").val(token.id));
		  Vendedor.secret=$("input[name=conektaTokenId]").val();
		  InformacionVenta.Pago.push(Vendedor);
		  console.log(InformacionVenta);
		  $.ajax({
		  		url: '/GuardarEnvio',
		  		type: 'POST',
		  		data: InformacionVenta,
		  		success: function (data) {
		  			if(data==true){
		  				$("#Promocion").modal('toggle');
		  			}else{
		  				console.log("Ocurrio un problema al registrar el pago: "+data);
		  			}
		  		}
		  	});
	};
	function BorrarArticulo (element) {
	event.preventDefault();
	jQuery.ajax({
		url: '/MisPublicaciones/BorrarArticulo',
		type: 'POST',
		dataType: 'HTML',
		data: { id: element.getAttribute('data-artic') },
		success: function (response) {
			document.getElementById('tablon').innerHTML = response;
			$('#modalBorrarPublicacion').modal('toggle');
		},
		error: function (a,b,c) {}
	})
};