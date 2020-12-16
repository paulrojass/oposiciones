<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>@yield('title') | Meforma</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="description" content="">
	<meta name="keywords" content="">
	<meta name="author" content="CreativeLayers">

	<!-- Favicon -->
	<link rel="shortcut icon" href="{{URL::asset('favicon.png')}}">

	<!-- Styles -->
	<link rel="stylesheet" type="text/css" href="{{URL::asset('tema/css/bootstrap-grid.css')}}" />
	<link rel="stylesheet" href="{{URL::asset('tema/css/icons.css')}}">
	<link rel="stylesheet" href="{{URL::asset('tema/css/animate.min.css')}}">
	<link rel="stylesheet" type="text/css" href="{{URL::asset('tema/css/style.css')}}" />
	<link rel="stylesheet" type="text/css" href="{{URL::asset('tema/css/responsive.css')}}" />
	<link rel="stylesheet" type="text/css" href="{{URL::asset('tema/css/chosen.css')}}" />
	<link rel="stylesheet" type="text/css" href="{{URL::asset('tema/css/colors/colors.css')}}" />
	<link rel="stylesheet" type="text/css" href="{{URL::asset('tema/css/bootstrap.css')}}" />
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css" />

	<link rel="stylesheet" type="text/css" href="{{URL::asset('css/estilos.css')}}" />

	@yield('css')
</head>
<body>

<div class="page-loading">
	<img src="{{URL::asset('tema/images/loader.gif')}}" alt="" />
</div>

<div class="theme-layout" id="scrollup">
	<div class="responsive-header three">
		<div class="responsive-menubar">
			<div class="res-logo"><a href="{{url('/')}}" title=""><img src="{{URL::asset('tema/images/logo.png')}}" alt="" /></a></div>
<!-- 			<div class="menu-resaction">
	<div class="res-openmenu">
		<img src="{{URL::asset('tema/images/icon5.png')}}" alt="" /> Menu
	</div>
	<div class="res-closemenu">
		<img src="{{URL::asset('tema/images/icon6.png')}}" alt="" /> Close
	</div>
</div> -->
		</div>
	</div>

	<header class="@yield('header_type')">
		<div class="menu-sec">
			<div class="container">
				<div class="logo">
					<a href="{{url('/')}}" title=""><img src="{{URL::asset('tema/images/logo.png')}}" alt="" /></a>
				</div><!-- Logo -->
				@if(Auth::User())
				@else
					@if(Route::currentRouteName() != 'login')
					<div class="btn-extars">
						<ul class="account-btns">
							<li class="signup-popup"><a href="{{url('login')}}" title=""><i class="la la-key"></i> Login</a></li>
						</ul>
					</div><!-- Btn Extras -->
					@endif
				@endif
				<nav>
				</nav><!-- Menus -->
			</div>
		</div>
	</header>

	@yield('content')

	<section>
		<div>
			<footer class="ft mt-0">
				<div class="bottom-line">
					<div class="container">
					<span>© Desarrollado por <a href="https://digitalmentestudio.com/">Digitalmente Studio</a></span>
						{{-- <a href="#scrollup" class="scrollup" title=""><i class="la la-arrow-up"></i></a> --}}
					</div>
				</div>
			</footer>
		</div>
	</section>



</div>

<script src="{{URL::asset('tema/js/jquery.min.js')}}" type="text/javascript"></script>
<script src="{{URL::asset('tema/js/modernizr.js')}}" type="text/javascript"></script>
<script src="{{URL::asset('tema/js/script.js')}}" type="text/javascript"></script>
<script src="{{URL::asset('tema/js/bootstrap.min.js')}}" type="text/javascript"></script>
<script src="{{URL::asset('tema/js/wow.min.js')}}" type="text/javascript"></script>
<script src="{{URL::asset('tema/js/slick.min.js')}}" type="text/javascript"></script>
<script src="{{URL::asset('tema/js/parallax.js')}}" type="text/javascript"></script>
<script src="{{URL::asset('tema/js/select-chosen.js')}}" type="text/javascript"></script>
<script src="{{URL::asset('tema/js/counter.js')}}" type="text/javascript"></script>
<script src="{{URL::asset('tema/js/mouse.js')}}" type="text/javascript"></script>

</body>

</html>
