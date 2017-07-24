@extends('base')
@section('contenido')
<style type="text/css">
	#infoWindow {
    width: 150px;
}
</style>
<meta charset="utf-8">
<div class="main-container">
	<div class="container">
		<div class="row">
		<div class="panel sidebar-panel panel-contact-seller">
		<div class="panel-heading">Resultados cercanos a tu posicion</div>
			<div class="panel-content user-info">
				<div class="panel-body text-center">
					<div id="map" style="height:600px;">
						
					</div>
				</div>
					</div>
		</div>
		</div>
		<div class="row">
		</div>
	</div>
</div>


<script type="text/javascript" src="https://conektaapi.s3.amazonaws.com/v0.3.2/js/conekta.js"></script>
<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAgU0-oncUskSc8OpZQfDizws5Ot7_11Gc"></script>
{{HTML::script('OfertasTorreon/assets/js/gmaps.js')}}
{{HTML::script('js/jquery.js')}}
{{HTML::script('js/star-rating.min.js')}}
{{HTML::script('js/star-rating.js')}}
{{HTML::script('OfertasTorreon/assets/bootstrap/js/bootstrap.min.js')}}
{{HTML::script('OfertasTorreon/assets/js/owl.carousel.min.js')}}
{{HTML::script('OfertasTorreon/assets/js/jquery.matchHeight-min.js')}}
{{HTML::script('OfertasTorreon/assets/js/hideMaxListItem.js')}}
{{HTML::script('OfertasTorreon/assets/plugins/jquery.fs.scroller/jquery.fs.scroller.js')}}
{{HTML::script('OfertasTorreon/assets/plugins/jquery.fs.selecter/jquery.fs.selecter.js')}}
{{HTML::script('OfertasTorreon/assets/js/script.js')}}
{{HTML::script('OfertasTorreon/jsOfertasTorreon/Ofertascercanas.js')}}
<script type="text/javascript">
$(document).ready(function  () {
	$("[name=Calificacion]").rating();
	$("[name=Calificacion2]").rating(); 

})
</script>
@stop
