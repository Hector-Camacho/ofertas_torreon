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
