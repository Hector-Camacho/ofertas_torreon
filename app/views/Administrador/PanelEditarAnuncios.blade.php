@extends('CuentaPrincipalAdministrador')
@section('content')
<div class="inner-box">
<h2 class="title-2"><i class="fa fa-star"></i>Estatus de las publicaciones del Banner</h2>
<div class="row" id="Aviso">
		<div class="col-lg-12">
			<div class="alert alert-success  alert-lg" role="alert">
				<h2 class="no-margin no-padding">&#10004; Aun no hay publicaciones dentro del banner</h2>
				<h4>Puedes hacer una publicacion justo <a href="/Panel/Administrador/NuevoAnuncio">aquí<a/></h4>
			</div>
		</div>
	</div> 
@if(Session::has('message'))
	<div class="row"id="message">
		<div class="col-lg-12">
			<div class="alert alert-{{ Session::get('class') }}  alert-lg" role="alert">
				<h2 class="no-margin no-padding">{{Session::get('icono')}} {{ Session::get('message')}}</h2>
				<h4>{{Session::get('info')}}</h4>
			</div>
		</div>
	</div>                  
	@endif

<div class="table-responsive">
<table id="addManageTable" class="table table-striped table-bordered add-manage-table table demo" data-filter="#filter" data-filter-text-only="true">
<thead>
<tr>
<th data-sort-ignore="true"> Detalles del anuncio </th>
<th> Opciones</th>
</tr>
</thead>
<tbody id="PublicacionesAdministrador" name="PublicacionesAdministrador">
	
	
	
</tbody>
</table>
</div>
</div>

		<div class="modal fade" id="modal-1">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
							<span class="sr-only">Close</span>
						</button>
						<h4 class="modal-title">Editar Anuncio</h4>
					</div>
					<div class="modal-body">
						<form class="form-horizontal" id="Formulario" role="form" enctype="multipart/form-data" action="/EditarAnuncio" method="post">
						<div class="form-group">
						<label class="col-sm-3 control-label">Nombre publicación</label>
						<div class="col-sm-9">
						<input type="text" class="form-control" id="NombrePublicacion" name="NombrePublicacion">
						</div>
						</div>
							
						<div class="form-group" hidden>
						<label class="col-sm-3 control-label">Nombre publicación</label>
						<div class="col-sm-9">
						<input type="text" class="form-control" id="idAnuncio" name="idAnuncio">
						</div>
						</div>
	
						<div class="form-group">
						<label class="col-sm-3 control-label">Nuevos días Limite</label>
						<div class="col-sm-9">
						<input type="text" class="form-control" id="DiasDuracion" name="DiasDuracion">
						</div>
						</div>
						<div class="form-group">
						<label class="col-sm-3 control-label">Nueva fotografía del anuncio</label>
						<div class="col-sm-9">
							<input id="input-upload-img1" name="Imagen1" type="file" class="file" data-preview-file-type="text">
						</div>
						</div>
						<div class="form-group">
						<div class="col-sm-offset-3 col-sm-9"> </div>
						</div>
						<div class="form-group">
						<div class="col-sm-offset-3 col-sm-9">
						
						</div>
						</div>
						
						
						
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
						<button type="submit" name="EditarAnuncio" id="EditarAnuncio" class="btn btn-primary">Guardar cambios</button>
					</div>
					</form>
				</div><!-- /.modal-content -->
			</div><!-- /.modal-dialog -->
		</div><!-- /.modal -->
		
		
		{{-- Modal eliminar --}}
		
				<div class="modal fade" id="modal-2">
					<div class="modal-dialog" role="document">
						<div class="modal-content">
							<div class="modal-header">
								<button type="button" class="close" data-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span>
									<span class="sr-only">Close</span>
								</button>
								<h4 class="modal-title">Confirmar acción</h4>
							</div>
							<div class="modal-body">
								<form action="/EliminarAnuncio" method="POST" accept-charset="utf-8">
								<div class="form-group" hidden>
								<label class="col-sm-3 control-label">Nombre publicación</label>
								<div class="col-sm-9">
								<input type="text" class="form-control" id="idAnuncioEliminar" name="idAnuncioEliminar">
								</div>
								</div>
								<h3>¿Desea eliminar el anuncio?</h3>
							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
								<button type="submit" name="EliminarAnuncio" id="EliminarAnuncio" class="btn btn-danger">Eliminar</button>
								</form>
							</div>
						</div><!-- /.modal-content -->
					</div><!-- /.modal-dialog -->
				</div><!-- /.modal -->
{{HTML::script('OfertasTorreon/jsOfertasTorreon/PublicacionesAnunciadas.js')}}
@stop