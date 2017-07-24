<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="utf-8">
	<meta property="og:url"           content="ofertas.torreon.com/" />
	<meta property="og:type"          content="website" />
	<meta property="og:title"         content="Ofertas torreon" />
	<meta property="og:description"   content="Encuentra esta y muchas mas ofertas!" />
	<meta property="og:image"         content="www.ofertas.torreon.com/public/OfertasTorreon/images/add2.jpg"/>
	<meta httl-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="shortcut icon" href='/favicon.png'>
	<title>Inicio | Ofertas Torreón</title>
	{{HTML::style('css/bootstrap.css')}}
	{{HTML::style('css/formValidation.min.css')}}
	{{HTML::style('css/style.css')}}
	{{HTML::style('OfertasTorreon/assets/css/fileinput.min.css')}}
	{{HTML::style('css/owl.carousel.css')}}
	{{HTML::style('css/owl.theme.css')}}
	{{HTML::style('OfertasTorreon/assets/plugins/bxslider/jquery.bxslider.css')}}
	{{HTML::style('css/style.css')}}
	{{HTML::style('css/star-rating.min.css')}}
	{{HTML::style('css/star-rating.css')}}
	<script> paceOptions = { elements: true }; </script>
	{{HTML::script('js/pace.min.js')}}
	{{HTML::script('js/jquery.js')}}
	{{HTML::script('js/bootstrap.js')}}
	{{HTML::script('js/formValidation.min.js')}}
	{{HTML::script('js/framework/bootstrap.min.js')}}
	{{HTML::script('OfertasTorreon/assets/js/fileinput.min.js')}}
	

	<style type="text/css">
		.ribbon {
  position: absolute;
  right: 0px; top: 0px;
  z-index: 1;
  overflow: hidden;
  width: 75px; height: 75px;
  text-align: right;
}
.ribbon span {
  font-size: 10px;
  font-weight: bold;
  color: #FFF;
  text-transform: uppercase;
  text-align: center;
  line-height: 20px;
  transform: rotate(45deg);
  -webkit-transform: rotate(45deg);
  width: 100px;
  display: block;
  background: #79A70A;
  background: linear-gradient(#F79E05 0%, #8F5408 100%);
  box-shadow: 0 3px 10px -5px rgba(0, 0, 0, 1);
  position: absolute;
  top: 19px; right: -21px;
}
.ribbon span::before {
  content: "";
  position: absolute; left: 0px; top: 100%;
  z-index: -1;
  border-left: 3px solid #8F5408;
  border-right: 3px solid transparent;
  border-bottom: 3px solid transparent;
  border-top: 3px solid #8F5408;
}
.ribbon span::after {
  content: "";
  position: absolute; right: 0px; top: 100%;
  z-index: -1;
  border-left: 3px solid transparent;
  border-right: 3px solid #8F5408;
  border-bottom: 3px solid transparent;
  border-top: 3px solid #8F5408;
}

 	.transition-timer-carousel .carousel-caption {
    background: -moz-linear-gradient(top,  rgba(0,0,0,0) 0%, rgba(0,0,0,0.1) 4%, rgba(0,0,0,0.5) 32%, rgba(0,0,0,1) 100%); /* FF3.6+ */
    background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,rgba(0,0,0,0)), color-stop(4%,rgba(0,0,0,0.1)), color-stop(32%,rgba(0,0,0,0.5)), color-stop(100%,rgba(0,0,0,1))); /* Chrome,Safari4+ */
    background: -webkit-linear-gradient(top,  rgba(0,0,0,0) 0%,rgba(0,0,0,0.1) 4%,rgba(0,0,0,0.5) 32%,rgba(0,0,0,1) 100%); /* Chrome10+,Safari5.1+ */
    background: -o-linear-gradient(top,  rgba(0,0,0,0) 0%,rgba(0,0,0,0.1) 4%,rgba(0,0,0,0.5) 32%,rgba(0,0,0,1) 100%); /* Opera 11.10+ */
    background: -ms-linear-gradient(top,  rgba(0,0,0,0) 0%,rgba(0,0,0,0.1) 4%,rgba(0,0,0,0.5) 32%,rgba(0,0,0,1) 100%); /* IE10+ */
    background: linear-gradient(to bottom,  rgba(0,0,0,0) 0%,rgba(0,0,0,0.1) 4%,rgba(0,0,0,0.5) 32%,rgba(0,0,0,1) 100%); /* W3C */
    filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#00000000', endColorstr='#000000',GradientType=0 ); /* IE6-9 */
	width: 100%;
	left: 0px;
	right: 0px;
	bottom: 0px;
	text-align: left;
	padding-top: 5px;
	padding-left: 15%;
	padding-right: 15%;
}
.transition-timer-carousel .carousel-caption .carousel-caption-header {
	margin-top: 10px;
	font-size: 24px;
}

@media (min-width: 970px) {
    /* Lower the font size of the carousel caption header so that our caption
    doesn't take up the full image/slide on smaller screens */
	.transition-timer-carousel .carousel-caption .carousel-caption-header {
		font-size: 36px;
	}
}
.transition-timer-carousel .carousel-indicators {
	bottom: 0px;
	margin-bottom: 5px;
}
.transition-timer-carousel .carousel-control {
	z-index: 11;
}
.transition-timer-carousel .transition-timer-carousel-progress-bar {
    height: 5px;
    background-color: #5cb85c;
    width: 0%;
    margin: -5px 0px 0px 0px;
    border: none;
    z-index: 11;
    position: relative;
}
.transition-timer-carousel .transition-timer-carousel-progress-bar.animate{
    /* We make the transition time shorter to avoid the slide transitioning
    before the timer bar is "full" - change the 4.25s here to fit your
    carousel's transition time */
    -webkit-transition: width 4.25s linear;
	-moz-transition: width 4.25s linear;
	-o-transition: width 4.25s linear;
	transition: width 4.25s linear;
}
 </style>
	<style>.themeControll{background:#2d3e50;height:auto;width:170px;position:fixed;left:0;padding:20px 0;top:100px;z-index:999999;-webkit-transform:translateX(0);-moz-transform:translateX(0);-o-transform:translateX(0);-ms-transform:translateX(0);transform:translateX(0);opacity:1;-ms-filter:none;filter:none;-webkit-transition:opacity .5s linear,-webkit-transform .7s cubic-bezier(.56,.48,0,.99);-moz-transition:opacity .5s linear,-moz-transform .7s cubic-bezier(.56,.48,0,.99);-o-transition:opacity .5s linear,-o-transform .7s cubic-bezier(.56,.48,0,.99);-ms-transition:opacity .5s linear,-ms-transform .7s cubic-bezier(.56,.48,0,.99);transition:opacity .5s linear,transform .7s cubic-bezier(.56,.48,0,.99);}.themeControll.active{display:block;-webkit-transform:translateX(-170px);-moz-transform:translateX(-170px);-o-transform:translateX(-170px);-ms-transform:translateX(-170px);transform:translateX(-170px);-webkit-transition:opacity .5s linear,-webkit-transform .7s cubic-bezier(.56,.48,0,.99);-moz-transition:opacity .5s linear,-moz-transform .7s cubic-bezier(.56,.48,0,.99);-o-transition:opacity .5s linear,-o-transform .7s cubic-bezier(.56,.48,0,.99);-ms-transition:opacity .5s linear,-ms-transform .7s cubic-bezier(.56,.48,0,.99);transition:opacity .5s linear,transform .7s cubic-bezier(.56,.48,0,.99);}.themeControll a{border-bottom:1px solid rgba(255,255,255,0.1);border-radius:0;clear:both;color:#fff;display:block;height:auto;line-height:16px;margin-bottom:5px;padding-bottom:8px;text-transform:capitalize;width:auto;}.tbtn{background:#2D3E50;color:#FFFFFF!important;font-size:30px;height:auto;padding:10px;position:absolute;right:-40px;top:0;width:40px;cursor:pointer;}.linkinner{display:block;height:400px;}.linkScroll .scroller-bar{width:17px;}.linkScroll .scroller-bar,.linkScroll .scroller-track{background:#1d2e40!important;border-color:#1d2e40!important;}@media (max-width: 780px) {.themeControll{display:none;}}</style>
</head>
<body>
<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/es_ES/sdk.js#xfbml=1&version=v2.6&appId=1129685747098075";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>
	<div id="wrapper">
		{{View::make('comp.header')}}	
	    @yield('contenido')
	</div>

	</div>
	

	
	{{HTML::script('js/owl.carousel.min.js')}}
	{{HTML::script('js/jquery.matchHeight-min.js')}}
	{{HTML::script('js/hideMaxListItem.js')}}
	{{HTML::script('js/jquery.fs.scroller.js')}}
	{{HTML::script('js/jquery.fs.selecter.js')}}
	{{HTML::script('js/script.js')}}
	{{HTML::script('js/usastates.js')}}
	{{HTML::script('OfertasTorreon/assets/plugins/bxslider/jquery.bxslider.min.js')}}
	{{HTML::script('OfertasTorreon/assets/js/form-validation.js')}}
	{{HTML::script('js/buscador.js')}}
	
	<script>
	$('.bxslider').bxSlider({
		pagerCustom: '#bx-pager'
	});
	</script>
</body>
</html>
