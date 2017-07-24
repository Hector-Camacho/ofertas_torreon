@if(Auth::user()->TipoUsuario!="Administrador")
	@extends('CuentaPrincipalUsuario')
@else
	@extends('CuentaPrincipalAdministrador')
@endif

@section('content')


<div class="inner-box">
<h2 class="title-2"><i class="fa fa-bullhorn"></i>Últimos Comentarios	</h2>
<div class="table-responsive">
<table id="addManageTable" class="table table-striped table-bordered add-manage-table table demo" data-filter="#filter" data-filter-text-only="true">
<thead>
<tr>
<th data-sort-ignore="true"> Detalles </th>
<th> Calificación
</th>
</tr>
</thead>
<tbody id="ComentariosDelUsuario">
</tbody>
</table>
</div>

 
</div>
</div>

{{HTML::script('OfertasTorreon/jsOfertasTorreon/VerComentarios.js')}}
<script>
$("[name=input-id]").rating()
</script>

@stop