@extends('layouts.tema')

@section('title', 'Inicio')

@section('header_type', 'stick-top')

@section('content')
<section>
	<div class="block no-padding">
		<div class="container fluid">
			<div class="row">
				<div class="col-lg-12">
					<div class="find-cand-sec">
						<div class="iconmove"><img class="animute" src="{{ asset('tema/images/resource/iconmove.jpg')}}" alt="" /></div>
						<div class="mockup-top"><img class="animute" src="{{ asset('tema/images/mockup.png')}}" alt="" /></div>
						<div class="mockup-bottom"><img src="{{ asset('tema/images/personas.png') }}" alt="" /></div>
						<div class="container">
							<div class="row">
								<div class="col-lg-8">
									<div class="find-cand">
										<h3>Test Online para </br> Oposiciones</h3>
										<span>Mide los resultados y avances en tu Oposición.</span>
										@auth
										<a href="{{ url('crear-examen') }}" title="" class="btn-crear">Crea Test</a>
										@else
										<a href="{{ url('crear-examen') }}" title="" class="btn-crear">Inicia Sesión</a>
										@endauth
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="scroll-to style2">
						<a href="#scroll-here" title=""><i class="la la-arrow-down"></i></a>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>

<section id="scroll-here">
	<div class="block">
		<div class="container">
			<div class="row">
				<div class="col-lg-12">
					<div class="heading">
						<h2>Garantiza tus resultados</h2>

					</div><!-- Heading -->
					<div class="cat-sec">
						<div class="row no-gape">
							<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
								<div class="p-category green">
									<a href="#" title="">
										<i class="la la-bullhorn"></i>
										<span>Test Personalizados</span>

									</a>
								</div>
							</div>
							<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
								<div class="p-category green">
									<a href="#" title="">
										<i class="la la-graduation-cap"></i>
										<span>Actualizaciones</span>

									</a>
								</div>
							</div>
							<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
								<div class="p-category green">
									<a href="#" title="">
										<i class="la la-line-chart "></i>
										<span>Historial de test</span>

									</a>
								</div>
							</div>
							<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
								<div class="p-category green">
									<a href="#" title="">
										<i class="la la-users"></i>
										<span>Multidispositivos</span>
									</a>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>

<section>
	<div class="block double-gap-top double-gap-bottom">
		<div data-velocity="-.1" style="background: url({{ asset('tema/images/fondo1.jpg') }}) repeat scroll 50% 422.28px transparent;" class="parallax scrolly-invisible layer color green"></div><!-- PARALLAX BACKGROUND IMAGE -->
		<div class="container">
			<div class="row">
				<div class="col-lg-12">
					<div class="simple-text-block">
	<h3>¡La mejor técnica de estudio!</h3>
<span>¡Haz la diferencia con nuestros test online demo!</span>
						@auth
						<a href="{{ url('crear-examen') }}" title="" class="rounded">Crea Test</a>
						@else
						<a href="{{ url('crear-examen') }}" title="" class="rounded">Inicia Sesión</a>
						@endauth
					</div>
				</div>
			</div>
		</div>
	</div>
</section>


{{--
<section>
	<div class="block remove-top">
		<div class="container">
			<div class="row">
				<div class="col-lg-12">
					<div class="heading">
						<h2>Como funciona</h2>

					</div><!-- Heading -->
					<div class="how-to-sec style2">
						<div class="how-to">
							<span class="how-icon"><i class="la la-user"></i></span>
							<h3>Registra tu usuario</h3>
							<p>Crea un nuevo usuaro con tu correo electrónico y accede a todas nuestras herramientas.</p>
						</div>
						<div class="how-to">
							<span class="how-icon"><i class="la la-file-archive-o"></i></span>
							<h3>Crea test personalizados</h3>
							<p>Crea tu test con nuestro creador personalizado utilizando los parámetros que desees.</p>
						</div>
						<div class="how-to">
							<span class="how-icon"><i class="la la-file-archive-o"></i></span>
							<h3>Resuelve los test</h3>
							<p>Soluciona tu test y obtén una calificación.Tómate el tiempo que necesites</p>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
--}}
<section>
	<div class="block">
		<div class="container">
			<div class="row">
				<div class="col-lg-12">
					<div class="heading">
						<h2>Grupo Meforma</h2>
						<span>Premios a la excelencia educativa.</span>
					</div><!-- Heading -->
					<div class="comp-sec">
						<img style="width:100%" src="{{asset('tema/images/premios.png')}}" alt="" />
					</div>
				</div>
			</div>
		</div>
	</div>
</section>

@endsection
