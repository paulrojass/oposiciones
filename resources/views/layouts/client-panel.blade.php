<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>@yield('title') | Meforma </title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="description" content="">
	<meta name="keywords" content="">
	<meta name="author" content="CreativeLayers">

	<!-- Favicon -->
	<link rel="shortcut icon" href="{{URL::asset('favicon.png')}}">

	<!-- Styles -->
	<link rel="stylesheet" type="text/css" href="{{ URL::asset('tema/css/bootstrap-grid.css')}}" />
	<link rel="stylesheet" href="{{ URL::asset('tema/css/icons.css')}}">
	<link rel="stylesheet" href="{{ URL::asset('tema/css/animate.min.css')}}">
	<link rel="stylesheet" type="text/css" href="{{ URL::asset('tema/css/style.css')}}" />
	<link rel="stylesheet" type="text/css" href="{{ URL::asset('tema/css/responsive.css')}}" />
	<link rel="stylesheet" type="text/css" href="{{ URL::asset('tema/css/chosen.css')}}" />
	<link rel="stylesheet" type="text/css" href="{{ URL::asset('tema/css/colors/colors.css')}}" />
	<link rel="stylesheet" type="text/css" href="{{ URL::asset('tema/css/custom.css')}}" />
<link rel="stylesheet" type="text/css" href="{{ URL::asset('tema/css/bootstrap.css')}}" />
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css" />
	
</head>
<body>

<div class="page-loading">
	<img src="{{ URL::asset('tema/images/loader.gif')}}" alt="" />
	<span>Skip Loader</span>
</div>

<div class="theme-layout" id="scrollup">
	
	<div class="responsive-header three">
		<div class="responsive-menubar">
			<div class="res-logo"><a href="{{ url('/') }}" title=""><img src="{{ asset('tema/images/logo.png') }}" alt="" /></a></div>
			<div class="menu-resaction">
				<div class="res-openmenu">
					<img src="images/icon5.png" alt="" /> Menu
				</div>
				<div class="res-closemenu">
					<img src="images/icon6.png" alt="" /> Close
				</div>
			</div>
		</div>
		<div class="responsive-opensec">
			<div class="btn-extars">
				@auth
				<ul class="account-btns">
					<li><a title=""><i class="la la-user"></i>Mi cuenta</a></li>
					<li><a href="{{ route('logout') }}" title=""><i class="la la-external-link-square"></i>Cerrar Sesión</a></li>
				</ul>
				@else					
				<ul class="account-btns">
					<li class="signup-popup"><a title=""><i class="la la-key"></i> Registrarse</a></li>
					<li class="signin-popup"><a title=""><i class="la la-external-link-square"></i> Inciar Sessión</a></li>
				</ul>
				@endauth
			</div><!-- Btn Extras -->
			<form class="res-search">
				<input type="text" placeholder="Job title, keywords or company name" />
				<button type="submit"><i class="la la-search"></i></button>
			</form>
			
		</div>
	</div>
	
	<header class="stick-top style3">
		<div class="menu-sec">
			<div class="container">
				<div class="logo">
					<a href="{{ url('/') }}" title=""><img src="{{ asset('tema/images/logo.png') }}" alt="" /></a>
				</div><!-- Logo -->
				<div class="btn-extars">
					@auth
					<ul class="account-btns">
						<li><a title=""><i class="la la-user"></i>Mi cuenta</a></li>
						<li><a href="{{ route('logout') }}" title=""><i class="la la-external-link-square"></i>Cerrar Sesión</a></li>

					</ul>
					@else						
					<ul class="account-btns">
						<li class="signup-popup"><a title=""><i class="la la-key"></i>Registrarse</a></li>
						<li class="signin-popup"><a title=""><i class="la la-external-link-square"></i>Iniciar Sesión</a></li>
					</ul>
					@endauth
				</div><!-- Btn Extras -->
				<nav>
					<ul>
						<li class="menu-item">
							<a href="{{url('crear-examen')}}" title="" style="color: #fff">Crear Examen</a>
						</li>
					</ul>
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

<script src="{{ asset('tema/js/jquery.min.js')}}" type="text/javascript"></script>
<script src="{{ asset('tema/js/modernizr.js')}}" type="text/javascript"></script>
<script src="{{ asset('tema/js/script.js')}}" type="text/javascript"></script>
<script src="{{ asset('tema/js/bootstrap.min.js')}}" type="text/javascript"></script>
<script src="{{ asset('tema/js/wow.min.js')}}" type="text/javascript"></script>
<script src="{{ asset('tema/js/slick.min.js')}}" type="text/javascript"></script>
<script src="{{ asset('tema/js/parallax.js')}}" type="text/javascript"></script>
<script src="{{ asset('tema/js/select-chosen.js')}}" type="text/javascript"></script>
<script src="{{ asset('tema/js/counter.js')}}" type="text/javascript"></script>
<script src="{{ asset('tema/js/mouse.js')}}" type="text/javascript"></script>

@yield('scripts')

</body>
</html>
