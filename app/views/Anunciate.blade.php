@extends('base')
@section('head')
<title>Anunciar | Ofertas Torreón</title>
{{ HTML::style('css/bootstrap.css') }}
{{ HTML::style('css/style.css') }}
{{ HTML::style('css/owl.carousel.css') }}
{{ HTML::style('css/owl.theme.css') }}
{{ HTML::style('OfertasTorreon/assets/plugins/bxslider/jquery.bxslider.css') }}
@endsection

@section('contenido')
 <div class="main-container">
 <div class="container"> 
 <div class="row">
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
<div class="col-md-9 page-content">
	<div class="inner-box category-content">
<h2 class="title-2 uppercase"><strong> <i class="icon-docs"></i>Publica tu anuncio  !</strong> </h2>

<form class="form-horizontal" role="form" enctype="multipart/form-data" action="/GuardarPatrocinado" method="post">
<div class="form-group">
<label class="col-sm-3 control-label">Nombre publicación</label>
<div class="col-sm-8">
<input type="text" class="form-control" id="NombrePublicacion" name="NombrePublicacion">
</div>
</div>
<div class="form-group">
<label class="col-sm-3 control-label">Días de duración de la publicación</label>
<div class="col-sm-8">
  <input type="text" class="form-control" id="DiasDuracion" name="DiasDuracion">
</div>
</div>
<div class="form-group">
<label class="col-sm-3 control-label">Fotografía del anuncio</label>
<div class="col-sm-8">
    <input id="input-upload-img1" name="AnuncioImg" type="file" class="file" data-preview-file-type="text">
</div>
</div>
<div class="form-group">
<div class="col-sm-offset-3 col-sm-9">
@if(Session::has('Permiso'))
    @if(Session::get('Permiso')=='Concedido');
       <button id="GuardarPatrocinado" type="submit" class="btn btn-success">Guardar anuncio</button>
    @else
       <button type="button" data-toggle="modal" href="#PagoTag" class="btn btn-success">¡Anunciame!</button>
    @endif
@endif
</div>
</div>
</form>


</div>
</div>

<div class="col-md-3 reg-sidebar">
<div class="reg-sidebar-inner text-center">
    
<div class="panel sidebar-panel">
<div class="panel-heading uppercase"><small><strong>¿Qué debes de tomar en cuenta?</strong></small></div>
<div class="panel-content">
<div class="panel-body text-left">
<ul class="list-check">
<li> Sube fotos que causen un gran impacto </li>
<li> Describe lo mejor posible tu artículo a publicar</li>
<li> Pon un precio razonable</li>
<li> Verifica la publicación antes de postearla</li>
<li> No utilices las publicaciones para bromear o estafar a los demás usuarios de esta comunidad</li>
</ul>
</div>
</div>
</div><div class="form-group">
    <label for="input" class="col-sm-2 control-label">:</label>
    <div class="col-sm-10">
        <input type="date" name="" id="input" class="form-control" value="" required="required" title="">
    </div>
</div>
</div>
</div> 
</div>
</div>
</div> 
<div class="modal fade" id="PagoTag">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Confirmacion de anuncio</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                        <form action="/GuardarPago" method="POST" id="PagoTarjeta" role="form">
                            <legend>Falta poco...</legend>
                        
                            <div class="form-group">
                                <label for="">Nombre del tarjetahabiente</label>
                                <input type="text" class="form-control" id="" data-conekta="card[name]" placeholder="¿Como te llamas?">
                            </div>
                            <div class="form-group">
                                <label for="">Numero de la tarjeta de credito</label>
                                <input type="text" class="form-control" id="" data-conekta="card[number]" placeholder="¿Cual es el numero de tu tarjeta?">
                            </div>
                            <div class="form-group">
                                <label for="">CVC</label>
                                <input type="text" class="form-control" id="" data-conekta="card[cvc]" placeholder="Introduce tu CVC aqui">
                            </div>
                              <div class="form-group">
                                <label for="">Fecha de expiración (MM/AAAA)</label>
                                <input type="text" class="form-control" id="" data-conekta="card[exp_month]" placeholder="Fecha de expiracion"><span>/</span> <input type="text" class="form-control" data-conekta="card[exp_year]"></input>
                            </div>
                        
                    </div>
                    <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                    <blockquote>
                    <div class="promo-text-box"> <i class=" icon-picture fa fa-4x icon-color-1"></i>
                        <h3><strong>Postea un anuncio</strong></h3>
                        <p> Alguien en alguna parte esta buscando tu negocio, ¡Haz que te encuentren!. </p>
                    </div></blockquote>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                <button type="submit" class="btn btn-primary">¡Pagar ahora!</button>
            </form>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript" src="https://conektaapi.s3.amazonaws.com/v0.3.2/js/conekta.js"></script>
    <script type="text/javascript">
      Conekta.setPublishableKey('key_O_6uGWU1xhMwzgzD');
    </script>
<script >
$(function(){
    $("#PagoTarjeta").submit(function(event){
        var $form = $(this);

        //Previene de hacer submit mas de una vez
        $form.find('button').prop("disabled",true);
        Conekta.token.create($form, conektaSuccessResponseHandler);
   
    // Previene que la información de la forma sea enviada al servidor
    return false;
    });
});
var conektaSuccessResponseHandler;
 conektaSuccessResponseHandler = function(token) {
  var $form = $("#PagoTarjeta");

  /* Inserta el token_id en la forma para que se envíe al servidor */
  $form.append($("<input type='hidden' name='conektaTokenId'>").val(token.id));
 
  /* and submit */
  $form.get(0).submit();
};
</script>
@endsection