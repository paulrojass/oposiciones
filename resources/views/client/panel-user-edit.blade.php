@extends('layouts.tema')

@section('title', 'Editar mi cuenta')

@section('header_type', 'gradient')

@section('content')
	<div class="block">
		<div class="container">
			<div class="row">
		 		<div class="col-lg-6 column">
			 		<div class="padding-left">
				 		<div class="manage-jobs-sec">
							<h3>Cambiar Datos</h3>
					 		<div class="change-password">
					 			<form action="{{ route('user-update') }}" method="POST">
									@csrf
					 				<div class="row">
					 					<div class="col-lg-8">
											<input type="hidden" name="id" value="{{$user->id}}">
					 						<span class="pf-title">Nombre</span>
					 						<div class="pf-field">
					 							<input type="input" id="name" name="name" value="{{$user->name}}"/>
					 						</div>
											<span class="pf-title">Correo electrónico (si cambia la dirección de correo se enviará un mensaje al nuevo correo con los nuevos datos de acceso)</span>
					 						<div class="pf-field">
					 							<input type="input" id="email" name="email" value="{{$user->email}}"/>
					 						</div>
											<div class="browse-all-cat mt-0">
												<button class="examen-button ml-2" type="submit">Actualizar</button>
											</div>
					 					</div>
					 				</div>
					 			</form>
					 		</div>
				 		</div>
					</div>
				</div>
				<div class="col-lg-6 column">
			 		<div class="padding-left">
				 		<div class="manage-jobs-sec">
							<h3>Cambiar Contraseña</h3>
					 		<div class="change-password">
					 			<form action="{{route('user-update-password')}}" method="post">
									@csrf
					 				<div class="row">
					 					<div class="col-lg-8">
											<input type="hidden" name="id" value="{{$user->id}}">
											<span class="pf-title">Nueva contraseña</span>
											<div class="pf-field">
												<input type="password" name="password" id="password" />
											</div>
											<span class="pf-title">Confirmar Contraseña</span>
											<div class="pf-field">
												<input type="password" name="password_confirmation" id="password_confirm"/>
											</div>
											<div class="browse-all-cat mt-0">
												<button class="examen-button ml-2" type="submit">Cambiar Contraseña</button>
											</div>
					 					</div>
					 				</div>
					 			</form>
					 		</div>
				 		</div>
					</div>
				</div>
			</div>
		</div>
	</div>

@endsection
