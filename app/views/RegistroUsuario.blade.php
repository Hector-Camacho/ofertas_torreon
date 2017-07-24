@extends('base')
@section('contenido')
<div class="main-container">
<div class="container">
<div class="row">
<div class="col-md-8 page-content">
<div class="inner-box category-content">
<h2 class="title-2"> <i class="icon-user-add"></i> Crea una cuenta, Es gratis! </h2>
<div class="row">
<div class="col-sm-12">
	
	@if(Session::has('message'))


	<div class="row">
		<div class="col-lg-12">
		<div class="alert alert-{{ Session::get('class') }}  alert-lg" role="alert">
		<h2 class="no-margin no-padding">&#10004; {{ Session::get('message')}}</h2>
		</div>
		</div>
</div>                  
@endif

	
<form class="form-horizontal" enctype="multipart/form-data" method="post" id="FormularioUsuario" action="RegistrarUsuario">
<fieldset>
 
<div class="form-group required">
<label class="col-md-4 control-label">Nombre completo:  <sup>*</sup></label>
<div class="col-md-6">
<input name="NombreUsuario" placeholder="Nombre(s)" class="form-control input-md" required="" type="text">
</div>
</div>
 

<div class="form-group required">
<label for="Email" class="col-md-4 control-label">Correo electrónico <sup>*</sup></label>
<div class="col-md-6">
<input type="email" name="Email" class="form-control" id="inputEmail3" placeholder="ejemplo">
</div>
</div>
<div class="form-group required">
<label for="password" class="col-md-4 control-label">Contraseña <sup>*</sup></label>
<div class="col-md-6">
<input type="password" name="password" class="form-control" id="password" placeholder="••••••">
</div>
</div>

<div class="form-group required">
<label for="password2" class="col-md-4 control-label">Confirmar contraseña </label>
<div class="col-md-6">
<input type="password"  name="password2"class="form-control" id="password2" placeholder="••••••">
</div>
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
<div class="col-md-6">
	<div style="clear:both"></div>
	<button class="btn btn-primary pull-right" type="submit" id="RegistrarUsuario">Registrarme!</button> 
</div>
</div>
</fieldset>
</form>




</div>
</div>
</div>
</div>
 
<div class="col-md-4 reg-sidebar">
<div class="reg-sidebar-inner text-center">
<div class="promo-text-box"> <i class=" icon-picture fa fa-4x icon-color-1"></i>
<h3><strong>Pública un anuncio gratuito.</strong></h3>
<p> Pública tus anuncios en línea. Haz que te conozcan. </p>
</div>
<div class="promo-text-box"> <i class=" icon-pencil-circled fa fa-4x icon-color-2"></i>
<h3><strong>Crea y administra tus publicaciones</strong></h3>
<p> Cambia o vende artículos que sea de tu interés.Hazlas conocer en toda la región.</p>
</div>
</div>
</div>
</div>
 
</div>
 
</div>


<script>
$('#FormularioUsuario').formValidation({
        framework: 'bootstrap',
        icon: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
        fields: {
        	
        	NombreUsuario: {
                validators: {
                	notEmpty:{
                		message:'No puedes dejar vacio este campo'
                	}
                }
            },
            Email: {
                validators: {
                	notEmpty:{
                		message:'No puedes dejar vacio este campo'
                	},
                	emailAddress: {
                        message: 'Este no es un formato correcto de Email'
                    },
                    regexp: {
                        regexp: '^[^@\\s]+@([^@\\s]+\\.)+[^@\\s]+$',
                        message: 'Ingresa una dirección correcta'
                    }
                }
            },
            password: {
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
            password2: {
                validators: {
                	identical:{
                		field:'password',
                    	message:'No coinciden las contraseñas'
                	}
                }
            }
        }
    });
</script>


{{HTML::script('OfertasTorreon/jsOfertasTorreon/RegistrarUsuario.js')}}
@stop	