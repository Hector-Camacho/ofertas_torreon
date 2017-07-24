@extends('base')
@section('head')
<title>Login | Ofertas Torreón</title>
{{ HTML::style('css/bootstrap.css') }}
{{ HTML::style('css/style.css') }}
{{ HTML::style('css/owl.carousel.css') }}
{{ HTML::style('css/owl.theme.css') }}
{{ HTML::style('OfertasTorreon/assets/plugins/bxslider/jquery.bxslider.css') }}

<!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
<![endif]-->
@endsection

@section('contenido')
{{HTML::script('js/jquery.js')}}
<div class="main-container">
<div class="container">
<div class="row">
<div class="col-sm-5 login-box">
<div class="panel panel-default">
<div class="panel-intro text-center">


</div>
<div class="panel-body">
{{ Form::open(array('url' => 'Login')) }}
<div class="form-group">
<label for="sender-email" class="control-label">Correo electrónico:</label>
<div class="input-icon"> <i class="icon-user fa"></i>
<input id="Correo" name="Correo" type="text" class="form-control email">
</div>
</div>

<div class="form-group">
<label for="sender-email" class="control-label">Contraseña:</label>
<div class="input-icon"> <i class="icon-lock fa"></i>
<input id="password" name="password" type="password" placeholder="Contraseña" class="form-control email">
</div>
{{ $errors->first('Contrasena') }}
<br>
@if ($error = $errors->first('password'))                                                      
<div class="alert alert-danger fade in">
   <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
   <i class="im-cancel alert-icon s24"></i>
{{ $error }}
</div>
@else
 @endif
 @if($error = $errors->first('status'))
 <div class="alert alert-danger fade in">
   <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
   <i class="im-cancel alert-icon s24"></i>
{{ $error }}
</div>
 @endif


</div>

<div class="form-group">
<button type="submit" class="btn btn-danger btn-block">Iniciar sesión</button>
</div>
<div class="form-group">
<a href="fbauth" style="background-color:#3258c2; color:whitesmoke;" class="btn btn-block" type="submit" id="LogFace"> <span class="icon icon-facebook"></span>Iniciar sesión con Facebook</a>
</div>
<div>
  <a href="RegistroUsuario"> Aun no tienes una cuenta? Registrate! </a>
</div>
{{ Form::close() }}
</div>
<div class="panel-footer">
<div class="checkbox pull-left">
<label> <input type="checkbox" value="1" name="remember" id="remember">Recuerdame</label>
</div>
<p class="text-center pull-right"> <a href="#"> Olvidaste tu contraseña? </a> </p>
<div style=" clear:both"></div>
</div>
</div>
<!-- <div class="login-box-btm text-center">
<p> No tienes una cuenta? <br>
<a href="RegistroUsuario"><strong>Registrate</strong> </a> </p>
</div> -->
</div>
</div>
</div>
</div>
 
<!-- <script type="text/javascript">
// This is called with the results from from FB.getLoginStatus().
  // This function is called when someone finishes with the Login
  // Button.  See the onlogin handler attached to it in the sample
  // code below.
  function checkLoginState() {
    FB.getLoginStatus(function(response) {
      statusChangeCallback(response);
    });
  }
  window.fbAsyncInit = function() {
  FB.init({
    appId      : '{884000378351637}',
    cookie     : true,  // enable cookies to allow the server to access 
                        // the session
    xfbml      : true,  // parse social plugins on this page
    version    : 'v2.5' // use graph api version 2.5
  });

  // Now that we've initialized the JavaScript SDK, we call 
  // FB.getLoginStatus().  This function gets the state of the
  // person visiting this page and can return one of three states to
  // the callback you provide.  They can be:
  //
  // 1. Logged into your app ('connected')
  // 2. Logged into Facebook, but not your app ('not_authorized')
  // 3. Not logged into Facebook and can't tell if they are logged into
  //    your app or not.
  //
  // These three cases are handled in the callback function.

  };

  // Load the SDK asynchronously
  (function(d, s, id) {
    var js, fjs = d.getElementsByTagName(s)[0];
    if (d.getElementById(id)) return;
    js = d.createElement(s); js.id = id;
    js.src = "//connect.facebook.net/en_US/sdk.js";
    fjs.parentNode.insertBefore(js, fjs);
  }(document, 'script', 'facebook-jssdk'));

  // Here we run a very simple test of the Graph API after login is
  // successful.  See statusChangeCallback() for when this call is made.
  function testAPI() {
    console.log('Welcome!  Fetching your information.... ');
    FB.api('/me', function(response) {
      console.log('Successful login for: ' + response.name);
      document.getElementById('status').innerHTML =
        'Thanks for logging in, ' + response.name + '!';
    });
  }

  $("#LogFace").click(function(){
 	checkLoginState();
  })
</script> -->
@endsection
