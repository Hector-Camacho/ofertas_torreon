@extends('CuentaPrincipalAdministrador')
@section('content')
<div class="inner-box">
<h2 class="title-2"><i class="fa fa-money"></i> Anuncios 	</h2>
<div class="row">
	<table id="TablaUsuarios1" class="table table-striped table-bordered add-manage-table table demo" data-filter="#filter" data-filter-text-only="true">
<thead>
<tr>
<th> Fotografía </th>
<th> Informacion </th>
<th> Opciones </th>

</tr>
</thead>
<tbody id="TablaAnuncios" >

</tbody>
</table>
</div>
<div class="modal fade" id="EliminarModal">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
			<h2 id="IdentificadorModal hidden"></h2>
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title">Eliminar publicacion marcada</h4>
			</div>
			<div class="modal-body">
				<div class="alert alert-danger pgray  alert-lg" role="alert">
					<h2 class="no-margin no-padding">¿Esta seguro de eliminar esta publicacion marcada?</h2>
					
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
				<button type="button" class="btn btn-danger" id="EliminarAn">Eliminar</button>
			</div>
		</div>
	</div>
</div>
<div class="modal fade" id="ModificarModal">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
			<h2 id="IdentificadorModal" hidden></h2>
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title">Modificar la publicacion marcada</h4>
			</div>
			<div class="modal-body">
				<div class="form-group">
					<label for="">¿Cuantos dias mas durara el auncio?</label>
					<input type="text" class="form-control" id="DiasNuevos" placeholder="Dias...">
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
				<button type="button" class="btn btn-primary" id="ModificarAn">Aceptar</button>
			</div>
		</div>
	</div>
</div>
</div>
{{HTML::script('OfertasTorreon/jsOfertasTorreon/MostrarAnuncios.js')}}
@endsection