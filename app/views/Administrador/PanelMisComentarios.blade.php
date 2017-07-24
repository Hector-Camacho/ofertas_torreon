@extends('CuentaPrincipalAdministrador')
@section('content')
<div class="inner-box">
	<h2 class="title-2"><i class="fa fa-bullhorn"></i> Reportes de publicaciones</h2>
	<div id="tablon">
		<?php
			$reportes = ReportePublicacion::select('reportespublicaciones.id', DB::raw('usuarios.id as usuario_id'), DB::raw('articulos.id as articulo_id'), 'articulos.NombreImagen1', DB::raw('articulos.Nombre as nombre_articulo'), 'reportespublicaciones.mensaje', 'reportespublicaciones.razondenuncia')
				->join('articulos', 'articulos.id', '=', 'reportespublicaciones.articulo_id')
				->join('usuarios', 'usuarios.id', '=', 'reportespublicaciones.usuario_id')
				->get()
		?>
		@if (ReportePublicacion::all()->count() > 0)
		<div class="table-responsive">
			<table id="addManageTable" class="table table-striped table-bordered add-manage-table table demo" data-filter="#filter" data-filter-text-only="true">
				<thead>
					<tr>
						<th> Fotografía </th>
						<th data-sort-ignore="true"> Detalles </th>
						<th> Acción </th>
					</tr>
				</thead>
				<tbody>
					@foreach ($reportes as $reporte)
					<tr>
						<td style="width:14%" class="add-img-td">
							<a href="#"><img class="thumbnail no-margin" src="/Imagenes/ImagenesArticulos/{{ $reporte['NombreImagen1'] }}"></a>
						</td>
						<td style="width:58%" class="ads-details-td">
							<div>
								<p><strong> Nombre de la publicación:</strong> <a href="{{ URL::to('/ArticuloDetallado', array('art_id' => $reporte['articulo_id'])) }}">{{ $reporte['nombre_articulo'] }}</a></p>
								<p><strong> Propietario de la publicación:</strong> <a href="#">{{ Usuario::find(Articulo::find($reporte['articulo_id'])->usuario_id)->Nombre }}</a></p>
								<p><strong> Causa:</strong> {{ $reporte['mensaje'] }}</p>
								<p><strong> Detalles:</strong> {{ $reporte['razondenuncia'] }}</p>
							</div>
						</td>
						<td style="width:16%">
							<p><button class="btn btn-danger btn-xs btn-block" onclick="$('#publicacionBorrar').modal('toggle'); document.getElementById('borrarArtic').setAttribute('artic-id', {{ $reporte['articulo_id'] }});"><i class="fa fa-trash"></i> Eliminar Publicación </button></p>
							<p><button class="btn btn-danger btn-xs btn-block" onclick="$('#reporteBorrar').modal('toggle'); document.getElementById('borrarReport').setAttribute('report-id', {{ $reporte['id'] }});"><i class="fa fa-times"></i> Eliminar Reporte </button></p>
						</td>
					</tr>
					@endforeach
				</tbody>
			</table>
		</div>
		@else
		<div class="row">
			<div class="col-lg-12">
				<div class="alert alert-success  alert-lg" role="alert">
					<h2 class="no-margin no-padding"><span class="fa fa-check"></span> Todo esta en completo orden por el momento.</h2>
					<h4>No hay reportes.</h4>
				</div>
			</div>
		</div>
		@endif
	</div>
</div>

<div class="modal fade" id="publicacionBorrar" data-backdrop="static" tabindex="-1">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title"><span class="fa fa-info-circle"></span> Aviso</h4>
			</div>
			<div class="modal-body">
				<h3>Esta a punto de eliminar esta publicación.</h3>
				<h3>Si el reporte de esta publicación no tiene razón válida para ser eliminada, solo elimina el reporte y no la publicación.</h3>
				<h3>De no ser así, puedes proceder a eliminar esta publicación.</h3>
				<div class="row">
					<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
						<button class="btn btn-success btn-block" id="borrarArtic" onclick="eliminarArticulo(this)">Si</button>
					</div>
					<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
						<button class="btn btn-danger btn-block" data-dismiss="modal">No</button>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="modal fade" id="reporteBorrar" data-backdrop="static" tabindex="-1">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title"><span class="fa fa-info-circle"></span> Aviso</h4>
			</div>
			<div class="modal-body">
				<h3>Esta a punto de eliminar este reporte.</h3>
				<h3>Ten encuenta que algunos reportes los hacen solo para molestar o para hacer ver mal a los demás.</h3>
				<h3>De ser así, procede a eliminar este reporte.</h3>
				<div class="row">
					<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
						<button class="btn btn-success btn-block" id="borrarReport" onclick="eliminarReporte(this)">Si</button>
					</div>
					<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
						<button class="btn btn-danger btn-block" data-dismiss="modal">No</button>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

{{HTML::script('OfertasTorreon/jsOfertasTorreon/VerComentarios.js')}}
<script>
$("[name=input-id]").rating()
</script>

@stop
