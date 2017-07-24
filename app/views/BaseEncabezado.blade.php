@extends('base')
@section('head')
<title>Anunciar | Ofertas Torreón</title>
{{ HTML::style('css/bootstrap.css') }}
{{ HTML::style('css/style.css') }}
{{ HTML::style('css/owl.carousel.css') }}
{{ HTML::style('css/owl.theme.css') }}
{{ HTML::style('OfertasTorreon/assets/plugins/bxslider/jquery.bxslider.css') }}

@endsection

@section('contenido')
 <div class="main-container">
 <div class="container"> 
 <div class="row">
<div class="col-md-9 page-content">
	<div class="inner-box category-content">
<h2 class="title-2 uppercase"><strong> <i class="icon-docs"></i>Publica tu artículo gratis!</strong> </h2>

@if(Session::has('message'))
	<div class="row">
		<div class="col-lg-12">
		<div class="alert alert-{{ Session::get('class') }}  alert-lg" role="alert">
		<h2 class="no-margin no-padding">{{Session::get('icono')}} {{ Session::get('message')}}</h2>
		<h4>{{Session::get('info')}}</h4>
		</div>
		</div>
</div>                  
@endif
<div class="row">
<div class="col-sm-12">
<form class="form-horizontal" id="FormularioArticulo" name="FormularioArticulo" enctype="multipart/form-data" action="RegistrarArticulo" method="post"> 
<fieldset>
 
<div class="form-group">
<label class="col-md-3 control-label">Categoria</label>
<div class="col-md-8">
<select name="Categorias" id="category-group" class="form-control">
<option value=""  selected="selected">Selecciona una categoria</option>
@foreach($Categorias as $Categoria)
<option value="{{$Categoria->id}}" style="background-color:#E9E9E9;font-weight:bold;" disabled="disabled">{{$Categoria->nombre}}</option>
		@foreach(DB::table('subcategorias')->where('categoria_id','=', $Categoria->id)->get() as $Resultado)
		<option value="{{$Resultado->id}}"> {{$Resultado->nombre}}
		 </option>
		@endforeach
@endforeach
</select>
</div>
</div>


<div class="form-group">
<label class="col-md-3 control-label">¿Que tipo de venta es?</label>
<div class="col-md-8">

<label class="radio-inline" for="radios-1">
<input name="radios" id="radios-1" value="Venta" checked="checked" type="radio">
Venta </label>
<label class="radio-inline" for="radios-0">
<input name="radios" id="radios-0" value="Cambio"  type="radio">
Cambio </label>
<label class="radio-inline" for="radios-0">
<input name="radios" id="radios-3" value="Ambos"  type="radio">
Ambos </label>
</div>
</div>
 
<div class="form-group">
<label class="col-md-3 control-label" for="Adtitle">Añadir titulo</label>
<div class="col-md-8">
<input id="Adtitle" name="Adtitle" placeholder="Título de la publicación" class="form-control input-md" required="" type="text">
<span class="help-block">Un buen titulo tiene menos de 50 caracteres. </span> </div>
</div>

<input id="longitud" name="longitud" hidden></input>
<input id="latitud" name="latitud" hidden></input>


<div class="form-group">
<label class="col-md-3 control-label" for="textarea">Describe tu articulo </label>
<div class="col-md-8">
<textarea class="form-control" id="textarea" name="textarea"style="resize: none;"rows="3" placeholder="Haz una descripción detallada de lo que ofreces (Marca, modelo, características especificas, etc.)"></textarea>
</div>
</div> 
<div class="form-group">
<label class="col-md-3 control-label" for="Price">Precio</label>
<div class="col-md-4">
<div class="input-group"> <span class="input-group-addon">$</span>
<input id="Price" name="Price" class="form-control" placeholder="Precio de venta" required="" type="text">
</div>
</div>
</div>
 
<div class="form-group">
<label class="col-md-3 control-label" for="textarea"> Fotografía(s) </label>
<div class="col-md-8">
<div class="mb10">
<input id="input-upload-img1" name="Imagen1" type="file" class="file" data-preview-file-type="text">
</div>
<div class="mb10">
<input id="input-upload-img2" name="Imagen2" type="file" class="file" data-preview-file-type="text">
</div>
<div class="mb10">
<input id="input-upload-img3" name="Imagen3" type="file" class="file" data-preview-file-type="text">
</div>
<div class="mb10">
<input id="input-upload-img4" name="Imagen4" type="file" class="file" data-preview-file-type="text">
</div>
<div class="mb10">
<input id="input-upload-img5" name="Imagen5" type="file" class="file" data-preview-file-type="text">
</div>
<p class="help-block">Sube hasta 5 fotos del articulo! Recuerda subir imagenes reales del artículo.</p>
</div>
</div>

<div class="form-group">
<label class="col-md-3 control-label" for="entrega"> Lugar de Entrega </label>
<div class="col-md-8">
<input class="form-control" id="entrega" name="entrega" style="resize:none;" rows="2" placeholder="Lugar donde se entregará el artículo.">
</div>
</div>
<div class="panel sidebar-panel panel-contact-seller">
                        <div class="panel-heading">¡Marca tu punto de entrega!</div>
                            <div class="panel-content user-info">
                                <div class="panel-body text-center">
                                    <div id="map" style="height:200px;">
                                        
                                    </div>
                                </div>
                            </div>
                    </div>
<div class="form-group">
<label class="col-md-3 control-label"></label>
<div class="col-md-8"> <button id="RegistrarArticulo" type="submit" class="btn btn-success btn-lg">Publicar artículo</button> </div>
</div>
</fieldset>
</form>
</div>
</div>
</div>

</div>

<div class="col-md-3 reg-sidebar">
<div class="reg-sidebar-inner text-center">
<div class="promo-text-box"> <i class=" icon-picture fa fa-4x icon-color-1"></i>
<h3><strong>Postea un anuncio</strong></h3>
<p> Vende o cambia lo que tu quieras. </p>
</div>
<div class="panel sidebar-panel">
<div class="panel-heading uppercase"><small><strong>¿Qué debes de tomar en cuenta?</strong></small></div>
<div class="panel-content">
<div class="panel-body text-left">
<ul class="list-check">
<li> Sube fotos que causen un gran impacto </li>
<li> Describe lo mejor posible tu artículo a publicar</li>
<li> Pon un precio razonable</li>
<li> Verifica la publicación antes de postearla</li>
<li> No utilices las publicaciones para bromear o estafar a los demás usuarios de esta comunidad</li>
</ul>
</div>
</div>
</div>
</div>
</div> 
</div>
</div>
</div> 
<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js"></script>
{{HTML::script('OfertasTorreon/assets/js/gmaps.js')}}
<script>
// initialize with defaults
$("#input-upload-img1").fileinput();
$("#input-upload-img2").fileinput();
$("#input-upload-img3").fileinput();
$("#input-upload-img4").fileinput();
$("#input-upload-img5").fileinput();

var mapObj= new GMaps({
    el:'#map',
    lat: 25.5394971,
    lng: -103.4529191
});



var clickedLocation = new google.maps.LatLng(location);

mapObj.addListener('click', function(e) {
    var longitud=e.latLng.lng();
    var latitud=e.latLng.lat();
       if(mapObj.markers.length>0){
            mapObj.removeMarkers();
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
        $("#longitud").val(longitud);
        $("#latitud").val(latitud);
});
</script>

<script >
$('#FormularioArticulo').formValidation({
        framework: 'bootstrap',
        icon: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
        fields: {
        	Adtitle: {
                validators: {
                	notEmpty:{
                		message:'No puedes dejar vacio este campo'
                	},
                	stringLength: {
                        max: 45,
                        message: 'El título solo puede tener 45 caracteres'
                    }
                }
            },
            Price: {
                validators: {
                	numeric: {
                            message: 'El valor ingresado no es númerico',
                            thousandsSeparator: '',
                            decimalSeparator: '.'
                        }
                }
            },
            entrega: {
                validators: {
                    notEmpty:{
                        message:'No puedes dejar vacio este campo'
                    },
                    stringLength: {
                        max: 200,
                        message: 'El nombre de lugar de entrega no puede tener más de 200 caracteres'
                    }
                }
            },
            Categorias:{
                validators:{
                    notEmpty:{
                        message:'No puedes dejar vacio este campo'
                    }
                }
            }
        }
    });
</script>


@endsection