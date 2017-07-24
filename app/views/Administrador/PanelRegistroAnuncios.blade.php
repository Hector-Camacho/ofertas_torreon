@extends('CuentaPrincipalAdministrador')
@section('content')
<div class="inner-box">
	<h2 class="title-2"><i class="fa fa-star"></i> Nuevo anuncio del Banner</h2>
	
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
	
<div class="panel panel-default">
<div class="panel-heading">
<h4 class="panel-title"> <a href="#collapseB1" data-toggle="collapse"> Registro de una publicación pagada</a> </h4>
</div>
<div class="panel-collapse">
<div class="panel-body">
<form class="form-horizontal" role="form" enctype="multipart/form-data" action="/GuardarAnuncio" method="post">
<div class="form-group">
<label class="col-sm-3 control-label">Nombre publicación</label>
<div class="col-sm-9">
<input type="text" class="form-control" id="NombrePublicacion" name="NombrePublicacion">
</div>
</div>
<div class="form-group">
<label class="col-sm-3 control-label">Días de duración de la publicación</label>
<div class="col-sm-9">
<input type="text" class="form-control" id="DiasDuracion" name="DiasDuracion">
</div>
</div>
<div class="form-group">
<label class="col-sm-3 control-label">Fotografía del anuncio</label>
<div class="col-sm-9">
	<input id="input-upload-img1" name="Imagen1" type="file" class="file" data-preview-file-type="text">
</div>
</div>
<div class="form-group">
<div class="col-sm-offset-3 col-sm-9"> </div>
</div>
<div class="form-group">
<div class="col-sm-offset-3 col-sm-9">
<button type="submit" id="GuardarAnuncio" name="GuardarAnuncio" class="btn btn-success">Guardar anuncio</button>
</div>
</div>
</form>
</div>
</div>
</div>
</div>







@stop

