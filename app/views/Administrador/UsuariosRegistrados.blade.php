@extends('CuentaPrincipalAdministrador')
@section('content')
<div class="inner-box">
@if(Session::has('message'))
	<div class="row">
        <div class="col-lg-12">
            <div class="alert alert-{{ Session::get('class') }}  alert-md" role="alert">
                <strong><h2 class="no-margin no-padding">{{Session::get('icono')}} {{ Session::get('message')}}</h2></strong>
                <h4>{{Session::get('description')}}</h4>
            </div>
        </div>
    </div> 
@endif
<h2 class="title-2"><i class="fa fa-users"></i> Usuarios registrados en el sistema	</h2>
<div class="table-responsive">
<table id="TablaUsuarios1" class="table table-striped table-bordered add-manage-table table demo" data-filter="#filter" data-filter-text-only="true">
<thead>
<tr>
<th> Fotografía </th>
<th> Informacion </th>
<th> Opciones </th>

</tr>
</thead>
<tbody id="TablaUsuarios" >
@foreach($Usuarios as $Usuario)
	<tr class="renglon">
			<td hidden class="IdentificadorUsuario">{{$Usuario->id}}</td>
			<td style="width:14%" class="add-img-td">
				<a href="ads-details.html">
					<img class="thumbnail no-margin" src="/Imagenes/AvatarUsuarios/{{$Usuario->NombreImagen}}">
				</a>
			</td>
			<td style="width:58%" class="ads-details-td">
				<div>
					<p><strong><a href="ads-details.html" title="{{$Usuario->Nombre}}">{{$Usuario->Nombre}}</a> </strong></p>
					<p> <strong>Correo: {{$Usuario->Correo}}</strong></p>
					<p> <strong>Ubicación:</strong>{{$Usuario->Ubicacion}}</p>
				</div>
			</td>

			<td style="width:10%" class="action-td">
				<div>
				@if($Usuario->estatus=="Baneado")
					<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
						<div class="row">
						<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
							<p> <a class="btn btn-primary btn-xs" data-toggle="modal" href="#DesBaneo"><i class="fa fa-check"></i> Desbanneo</a></p>
						</div>
						</div>
					</div>
				@else
					<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
						<div class="row">
						<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
							<p> <a class="btn btn-success btn-xs" data-toggle="modal" href="#MensajePer"> <i class=" fa fa-envelope"></i> Mandar mensaje personalizado </a></p>
							<p> <a class="btn btn-primary btn-xs" data-toggle="modal" href="#MensajeAdv"> <i class=" fa fa-envelope"></i><i class=" fa fa-exclamation"></i> Enviar mensaje de advertencia </a></p>
						</div>
						</div>
						<div class="row">
						<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
							<p> <a class="btn btn-danger btn-xs" data-toggle="modal" href="#Bannear"> <i class=" fa fa-ban"></i> Bannear </a></p>
						</div>
						</div>
					</div>
				@endif
				</div>
				</td>
			</tr>	
@endforeach
</tbody>
</table>
</div>

</div>
<div class="modal fade" id="MensajeAdv">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title">Mensaje de advertencia</h4>
			</div>
			<div class="modal-body">
			<h2 id="IdentificadorModal" hidden></h2>
			<label>Mensaje:</label>
				<textarea class="form-control" id="MensajeModal" name="MensajeModal" rows="7">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
				tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
				quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
				consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
				cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
				proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</textarea>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
				<button type="button" class="btn btn-primary" id="EnvMensajeAdv">Enviar mensaje</button>
			</div>
		</div>
	</div>
</div>
<div class="modal fade" id="MensajePer">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title">Mensaje personalizado</h4>
			</div>
			<h2 id="IdentificadorModal" hidden></h2>
			<div class="modal-body">
			<label>Enviar mensaje a:</label>
				<textarea class="form-control" id="MensajeModal" name="MensajeModal" rows="7"></textarea>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
				<button type="button" class="btn btn-primary" id="EnvMensajePer">Enviar mensajes</button>
			</div>
		</div>
	</div>
</div>
<div class="modal fade" id="Bannear">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
			<h2 id="IdentificadorModal" hidden></h2>
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title">Banear usuario</h4>
			</div>
			<div class="modal-body">
				<div class="alert alert-danger pgray  alert-lg" role="alert">
					<h2 class="no-margin no-padding"> ¿Estas seguro de banear a este usuario?</h2>
					<p>Este usuario no podra volver a acceder al sistema mientras este banneado, esta accion puede deshacerce en un futuro</p>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
				<button type="button" class="btn btn-danger" id="Ban">Banear</button>
			</div>
		</div>
	</div>
</div>
<div class="modal fade" id="DesBaneo">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
			<h2 id="IdentificadorModal" hidden></h2>
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title">Remover banneo a usuario</h4>
			</div>
			<div class="modal-body">
				<div class="alert alert-success pgray  alert-lg" role="alert">
					<h2 class="no-margin no-padding"> ¿Estas seguro de remover la restriccion de acceso al sistema a este usuario?</h2>
					<p>Recuerda que el motivo de banneo pudo haber infringido las normas de comportamiento dentro de la comunidad.</p>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
				<button type="button" class="btn btn-success" id="Desbannear">Desbannear</button>
			</div>
		</div>
	</div>
</div>
{{HTML::script('OfertasTorreon/jsOfertasTorreon/MostrarUsuarios.js')}}
@stop