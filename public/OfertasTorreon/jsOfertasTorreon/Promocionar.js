$("#StatusPago").hide();
Conekta.setPublishableKey('key_O_6uGWU1xhMwzgzD');
$("#PromocionarArticuloButton").click(function(){
	    var $form = $("#PagoTarjeta");
	    Conekta.token.create($form, conektaSuccessResponseHandler);
   		return false;
		
	});
	var conektaSuccessResponseHandler;
	 conektaSuccessResponseHandler = function(token) {
	 	var $form = $(this);
	 	$form.find('button').prop("disabled",true);
	 	var Datos={
	 		Token:"",
	 		idArticulo:""
	 	}
	 	Datos.Token=token;
	 	Datos.idArticulo=$("#idArticuloDetalle").text();
	 	 $.ajax({
		  		url: '/GuardarOferta',
		  		type: 'POST',
		  		data: Datos,
		  		dataType:"JSON",
		  		success: function (data) {
		  			$("#StatusPago").show();	
		 			$("#Alerta").addClass('alert alert-'+data.Clase+' alert-lg');
		 			$("#Informacion").text("¡"+data.Mensaje+"!");
		 			$("#Mensaje").text("Informacion sobre el pago");
		 			$("#PagoTarjeta")[0].reset();
		 			setTimeout(MostrarModal,6000);

		 			function MostrarModal(){
		 				$("#Promocion").modal('toggle');
		  			}
		 		}
		  	});
	};