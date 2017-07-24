@extends('CuentaPrincipalUsuario')
@section('content')
<div class="inner-box">
<div class="welcome-msg">
<h3 class="page-sub-header2 clearfix no-padding">Configuración de tu cuenta </h3>

<div id="accordion" class="panel-group">
<div class="panel panel-warning">
    
    

<div class="panel-heading">
<h4 class="panel-title"> <a href="#collapseB1" data-toggle="collapse"> Información personal </a> </h4>
</div>
<div class="panel-collapse collapse in" id="collapseB1">
<div class="panel-body">
<form class="form-horizontal" enctype="multipart/form-data"  id="FormularioUsuario" action="/EditarPerfilUsuario" method="post">


<div class="form-group">
<div class="col-sm-offset-3 col-sm-9"> </div>
</div>

<div class="form-group required">
<label class="col-md-4 control-label">Nombre completo:  <sup>*</sup></label>
<div class="col-md-6">
<input name="NombreUsuario" placeholder="Nombre(s)" value="{{$InfoUsuario->Nombre}}" class="form-control input-md" required="" type="text">
</div>
</div>
 

<div class="form-group required">
<label for="Email" class="col-md-4 control-label">Correo electrónico <sup>*</sup></label>
<div class="col-md-6">
<input type="email" name="Email" class="form-control" id="inputEmail3" value="{{$InfoUsuario->Correo}}" placeholder="ejemplo">
</div>
</div>

<div class="form-group">
	<center>
		<img class="no-margin" style="width:150px; height:150px;" src="/Imagenes/AvatarUsuarios/{{$InfoUsuario->NombreImagen}}" alt="img">
	</center>
	<center>
		<label>Avatar actual</label>
	</center>
</div>

<div class="form-group">
<label class="col-md-3 control-label" for="textarea"> Fotografía  </label>
<div class="col-md-8">
<div class="mb10">
<input id="Imagen" name="Imagen" type="file" class="file" data-preview-file-type="text">
</div>
<p class="help-block">Sube una foto que te distinga.</p>
</div>
</div>

<div class="form-group">
<div class="col-sm-offset-3 col-sm-9">
<button type="submit" class="btn btn-primary" id="EditarPerfilUsuario" name="EditarPerfilUsuario">Actualizar información</button>
</div>
</div>
</form>
</div>
</div>
</div>
<br>
@if(Session::has('message'))
    <div class="row">
        <div class="col-lg-12">
            <div class="alert alert-{{ Session::get('class') }}  alert-md" role="alert">
                <h4 class="no-margin no-padding">{{Session::get('icono')}} {{ Session::get('message')}}</h4>
                <h4>{{Session::get('info')}}</h4>
            </div>
        </div>
    </div>                  
@endif

<div class="panel panel-default">
<div class="panel-heading">
<h4 class="panel-title"> <a href="#collapseB2" data-toggle="collapse"> Configuración de contraseña </a> </h4>
</div>
<div class="panel-collapse collapse" id="collapseB2">
<div class="panel-body">
<form class="form-horizontal" name="FormContrasena" action="/CambiarContrena" method="post" role="form">
<div class="form-group">
<label class="col-sm-3 control-label">Escribe tu contraseña actual</label>
<div class="col-sm-9">
<input type="password" class="form-control" name="Actual" placeholder="">
</div>
</div>

<div class="form-group">
<label class="col-sm-3 control-label">Nueva contraseña</label>
<div class="col-sm-9">
<input type="password" class="form-control" name="Nueva" id="Nueva" placeholder="">
</div>
</div>
<div class="form-group">
<label class="col-sm-3 control-label">Confirmar contraseña</label>
<div class="col-sm-9">
<input type="password" class="form-control" name="ConfirmarNueva" placeholder="">
</div>
</div>
<div class="form-group">
<div class="col-sm-offset-3 col-sm-9">
<button type="submit" class="btn btn-success" name="CambiarContrena" id="CambiarContrena">Actualizar contraseña</button>
</div>
</div>
</form>
</div>
</div>
</div>
</div>
 
</div>

<script type="text/javascript">
$('[name=FormContrasena]').formValidation({
        framework: 'bootstrap',
        icon: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
        fields: {
            Nueva: {
                validators: {
                	notEmpty:{
                		message:'No puedes dejar vacio este campo'
                	},
                	stringLength: {
                        min:6,
                        max: 50,
                        message: 'Usa una contraseña de mínimo 6 caracteres'
                    }
                }
            },
            ConfirmarNueva: {
                validators: {
                	identical:{
                		field:'Nueva',
                    	message:'No coinciden las contraseñas'
                	}
                }
            }
        }
    });
</script>
@stop