GMaps.geolocate({
  success: function(position){
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
	mapObj.drawCircle({
		  lat:position.coords.latitude,
		  lng: position.coords.longitude,
		 strokeColor: '#449d44',
	      strokeOpacity: 0.8,
	      strokeWeight: 2,
	      fillColor: '#449d44',
	      fillOpacity: 0.35,
	      radius: 1000
	});
	$.ajax({
		url: '/harvesine',
		type: 'POST',
		data: { lat:position.coords.latitude,lng: position.coords.longitude},
	  	dataType:'JSON',
		success: function (articulos) {
			$.each(articulos, function( index, articulo ) {
			  mapObj.addMarker({
			  	lat: articulo.latitud,
			  	lng: articulo.longitud,
			  	title:articulo.Nombre,
			  	 infoWindow: {
			  	 	content: '<div class="item-list">\
									<div class="col-sm-4 no-padding photobox">\
										<div class="add-image">\
											<a >\
												<img class="thumbnail no-margin" src="../../Imagenes/ImagenesArticulos/'+articulo.NombreImagen1+'" alt="imagen">\
											</a>\
										</div>\
									</div>\
									<div class="col-sm-5 add-desc-box">\
										<div class="add-details">\
											<h3 class="add-title">\
												<a >'+articulo.Nombre+'</a>\
											</h3>\
											<span class="info-row">\
												<span class="date"><li class="fa fa-calendar" aria-hidden="true"></li>\
												Fecha de publicacion: '+articulo.FechaPublicacion+	'</span>\
												<span class="category"></span>\
												<span class="item-locaton"><i class="fa fa-street-view" aria-hidden="true"></i>\
												Lugar de entrega:'+articulo.UbicacionArticulo+'</span>\
											</span>\
										</div>\
									</div>\
									<div class="col-sm-3 text-right price-box">\
										<div class="add-details">\
											<h2 class="item-price">$'+articulo.Precio+'</h2>\
										</div>\
									</div>\
								</div>',
				    maxWidth: 900
				  },
				  mouseover: function(e){
	                this.infoWindow.open(this.map, this);
	              },
	              mouseout:function(e){
	              	this.infoWindow.close();
	              }
			  });
			});
		}
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