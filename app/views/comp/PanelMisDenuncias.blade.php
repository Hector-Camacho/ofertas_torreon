@extends ('CuentaPrincipalUsuario')
@section ('content')
<div class="inner-box">
	<h2 class="title-2"><i class="fa fa-list"></i> Mis denuncias</h2>
	<div id="tablon">
		@if (Usuario::find(Auth::id())->Denuncias->count() > 0)
		<div class="table-responsive">
			<table id="addManageTable" class="table table-striped table-bordered add-manage-table table demo" data-filter="#filter" data-filter-text-only="true">
				<thead>
					<tr>
						<th> Fotografía </th>
						<th> Nombre </th>
						<th data-sort-ignore="true"> Detalles </th>
						<th> Fecha </th>
						<th> Opciones </th>
					</tr>
				</thead>
				<tbody>
					@foreach (Usuario::find(Auth::id())->Denuncias as $denuncia)
					<tr>
						<td style="width:15%" class="add-img-td">
							<img class="thumbnail no-margin" src="/Imagenes/ImagenesDenuncias/{{ $denuncia->NombreImagen }}">
						</td>
						<td style="width:15%" class="ads-details-td">
							<div>
								<p>{{ $denuncia->Titulo }}</p>
							</div>
						</td>
						<td style="width:40%" class="ads-details-td">
							<div>
								<p>{{ $denuncia->Descripcion }}</p>
							</div>
						</td>
						<td style="width:15%" class="ads-details-td">
							<div>
								<p>{{ $denuncia->Fecha }}</p>
							</div>
						</td>
						<td style="width:15%" class="action-td">
							<div>
								<p><a class="btn btn-primary btn-xs btn-block" href="#" data-den="{{ $denuncia->id }}" onclick="traerDenuncia(this)"><i class="fa fa-edit"></i> Editar </a></p>
								<hr>
								<p><a class="btn btn-danger btn-xs btn-block" href="#" onclick="event.preventDefault(); $('#modalBorrarDenuncia').modal('toggle'); document.getElementById('borrarYa').setAttribute('data-den', {{ $denuncia->id }})"><i class="fa fa-times"></i> Eliminar </a></p>
							</div>
						</td>
					</tr>
					@endforeach
				</tbody>
			</table>
		</div>
		@else
		<div class="row">
			<div class="col-lg-12">
				<div class="alert alert-success alert-lg" role="alert">
					<h2 class="no-margin no-padding"><span class="fa fa-check"></span> Al parecer nadie te ha quedado mal, eso es bueno :)</h2>
				</div>
			</div>
		</div>
		@endif
	</div>
</div>

{{-- Modal --}}
<div class="modal fade" id="modalEditarDenuncia" data-backdrop="static" tabindex="-1" >
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title"><span class="fa fa-info-circle"></span> Aviso</h4>
			</div>
			<div class="modal-body">
				<form class="form-horizontal form-bordered" name="FormEditarPublicacion">
					<div class="form-group">
						<label class="col-sm-3 control-label" for="denTitulo">Titulo</label>
						<div class="col-sm-9">
							<input type="text" id="denTitulo" name="denTitulo" class="form-control" placeholder="Titulo de la denuncia">
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-3 control-label" for="denDetalles">Detalles</label>
						<div class="col-md-9">
							<textarea id="denDetalles" name="denDetalles" class="form-control" style="resize: none;" rows="3" placeholder="Detalles de la denuncia" type="text"></textarea>
						</div>
					</div>
				</form>
			</div>
			<div class="modal-footer">
				<div class="form-group">
					<div class="col-sm-offset-3 col-sm-9">
						<button id="editarDenuncia" class="btn btn-success" onclick="editarDenuncia(this)"><span class="fa fa-check"></span> Actualizar</button>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="modal fade" id="modalBorrarDenuncia" data-backdrop="static" tabindex="-1" >
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title"><span class="fa fa-info-circle"></span> Aviso</h4>
			</div>
			<div class="modal-body">
				<h3>Esta a punto de eliminar esta denuncia.</h3>
				<h3>¿Desea continuar?</h3>
				<div class="row">
					<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
						<button class="btn btn-success btn-block" id="borrarYa" onclick="borrarDenuncia(this)">Si</button>
					</div>
					<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
						<button class="btn btn-danger btn-block" onclick="$('#modalBorrarDenuncia').modal('toggle')">No</button>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<script>
function traerDenuncia (element) {
	event.preventDefault();
	jQuery.ajax({
		url: '/MisDenuncias/MostrarDenuncia',
		type: 'POST',
		dataType: 'JSON',
		data: { id: element.getAttribute('data-den') },
		success: function (response) {
			document.getElementById('denTitulo').value = response.Titulo;
			document.getElementById('denDetalles').value = response.Descripcion;
			document.getElementById('editarDenuncia').setAttribute('data-den', element.getAttribute('data-den'));
			$('#modalEditarDenuncia').modal('toggle');
		},
		error: function (a,b,c) {}
	})
};

function editarDenuncia (element) {
	jQuery.ajax({
		url: '/MisDenuncias/EditarDenuncia',
		type: 'POST',
		dataType: 'HTML',
		data: {
			id: element.getAttribute('data-den'),
			denTitulo: document.getElementById('denTitulo').value,
			denDetalles: document.getElementById('denDetalles').value
		},
		success: function (response) {
			$('#modalEditarDenuncia').modal('toggle');
			document.getElementById('tablon').innerHTML = response;
		},
		error: function (a,b,c) {}
	})
};

function borrarDenuncia (element) {
	jQuery.ajax({
		url: '/MisDenuncias/BorrarDenuncia',
		type: 'POST',
		dataType: 'HTML',
		data: { id: element.getAttribute('data-den') },
		success: function (response) {
			$('#modalBorrarDenuncia').modal('toggle');
			document.getElementById('tablon').innerHTML = response;
		},
		error: function (a,b,c) {}
	})
};
</script>
@stop
