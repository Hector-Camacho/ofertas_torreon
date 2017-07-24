@extends ('CuentaPrincipalUsuario')
@section ('content')
<div class="inner-box">
	<h2 class="title-2"><i class="fa fa-exclamation"></i> Denunciar</h2>
	@if (Session::has('message'))
	<div class="row">
		<div class="col-lg-12">
			<div class="alert alert-{{ Session::get('class') }} alert-lg" role="alert">
				<h2 class="no-margin no-padding">{{ Session::get('icono') }} {{ Session::get('message') }}</h2>
				<h4>{{ Session::get('info') }}</h4>
			</div>
		</div>
	</div>
	@endif
	<div class="row">
		<div class="col-sm-12">
			<form class="form-horizontal" id="FormularioDenuncia" name="FormularioDenuncia" enctype="multipart/form-data" action="RegistrarDenuncia" method="post"> 
				<fieldset>
					<div class="form-group">
						<label class="col-md-3 control-label">Título</label>
						<div class="col-md-9">
							<input type="text" id="den-title" name="dentitle" class="form-control" placeholder="Título de la denuncia">
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-3 control-label">Descripción</label>
						<div class="col-md-9">
							<textarea class="form-control" id="den-descript" name="dendescript" style="resize: none;" rows="3" placeholder="Haz una breve explicación de lo que este usuario hiso o cometió."></textarea>
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-3 control-label">Imagen</label>
						<div class="col-md-9">
							<div class="mb10">
								<input id="Imagen1" name="Imagen1" type="file" class="file" data-preview-file-type="text">
							</div>
						</div>
					</div>
					<div class="form-group">
						<div class="col-md-9 col-md-offset-3">
							<button id="RegistrarDenuncia" type="submit" class="btn btn-success btn-lg">Publicar artículo</button>
						</div>
					</div>
				</fieldset>
			</form>
		</div>
	</div>
</div>
<script>
$("#Imagen1").fileinput();
</script>
@stop
