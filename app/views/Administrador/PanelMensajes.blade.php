@extends('CuentaPrincipalAdministrador')

@section('content')
<div class="inner-box">
<h2 class="title-2"><i class="fa fa-bullhorn"></i> Mensajes recibidos	</h2>
<div class="table-responsive" id="TM" name="TM">
<table id="addManageTable" class="table table-striped table-bordered add-manage-table table demo" data-filter="#filter" nam="TabMensajes" data-filter-text-only="true">
<thead>
<tr>
<th data-sort-ignore="true"> Detalles </th>
<th> Opción
</th>
</tr>
</thead>
<tbody id="MensajesDelUsuario">
</tbody>
</table>




</div>
<div class="row" id="AlertaSinMensajes">
	<div class="col-lg-12">
		<div class="alert alert-success  alert-lg" role="alert">
			<h2 class="no-margin no-padding"><span class="fa fa-check-circle">  Sin mensajes</span></h2>
		<h4>Vuelve a ver las nuevas ofertas publicadas.</h4>
		</div>
	</div>
</div>
 
</div>
</div>










<div class="modal fade" id="modalEditarPublicacion" data-backdrop="static" tabindex="-1" >
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title"><span class="fa fa-info-circle"></span> Respuesta</h4>
			</div>
			<div class="modal-body">
				<form class="form-horizontal form-bordered" name="FormEditarPublicacion">
					<div class="form-group">
					<label class="col-sm-3 control-label">Mensaje</label>
					<div class="col-sm-9">
						<textarea name="RespuestaAlMensaje" class="form-control" style="resize: none;"rows="3" resize></textarea>
					</div>
					</div>
				</form>
			</div>
			<div class="modal-footer">
				<div class="form-group">
					<div class="col-sm-offset-3 col-sm-9">
					<button type="button" name="EnviarRespuesta" class="btn btn-success"><span class="fa fa-angle-double-right"></span> Enviar</button>
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