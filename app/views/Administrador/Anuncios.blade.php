@extends('CuentaPrincipalAdministrador')
@section('content')
<div class="inner-box">
<h2 class="title-2"><i class="fa fa-money"></i> Anuncios 	</h2>
<form class="form" role="form" id="FormularioAnuncio">
<div class="row">
	<?php $Usuario= new Usuario();
		 $Usuarios=$Usuario::all();
	 ?>
	<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
		<div class="form-group">
			<label>¿Que publicacion anunciaras?</label>
			<select name="Publicacion" id="input" class="form-control" required="required">
			@foreach($Usuarios as $Usuario)
			<option value="{{$Usuario->id}}" style="background-color:#E9E9E9;font-weight:bold;" disabled="disabled">{{$Usuario->Nombre}}</option>
				@foreach(DB::table('articulos')->where('usuario_id','=', $Usuario->id)->select('articulos.Nombre','articulos.id')->get() as $Articulo)
					<option value="{{$Articulo->id}}"> {{$Articulo->Nombre}}</option>
				@endforeach
			@endforeach
			</select>
		</div>
	</div>
	<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
			<div class="form-group">
				<label>¿Cuantos dias durara?</label>
				<input type="number" name="Dias" class="form-control" id="" placeholder="¿Cuantos dias durara el anuncio?">
			</div>
	</div>
</div>

	<button type="button" id="RegistrarAnuncio" class="btn btn-primary">Publicar anuncio</button>
</form>
 
 <div class="row">

 </div>
</div>
{{HTML::script('OfertasTorreon/jsOfertasTorreon/RegistrarAnuncios.js')}}
@endsection