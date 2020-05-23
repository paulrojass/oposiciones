@extends('layouts.tema')

@section('title', 'Perfil de usuario')

@section('content')
<section class="overlape">
	<div class="block no-padding">
		<div data-velocity="-.1" style="background: url(http://placehold.it/1600x800) repeat scroll 50% 422.28px transparent;" class="parallax scrolly-invisible no-parallax"></div><!-- PARALLAX BACKGROUND IMAGE -->
		<div class="container fluid">
			<div class="row">
				<div class="col-lg-12">
					<div class="inner-header">
						<h3>Mi cuenta</h3>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
<section>
	<div class="block">
		<div class="container">
			<div class="row">
			 	<div class="col-lg-12 column">
			 		<div class="job-single-sec style3">
			 			<div class="job-head-wide">
			 				<div class="row">
			 					<!-- <div class="col-lg-10"> -->
		 						<div class="job-single-head3 emplye">
					 				<div class="job-single-info3">
					 					<h3>{{ $user->name }}</h3>
					 					<span><i class="la la-envelope"></i>{{ $user->email }}</span>
					 					


					<!-- <a data-toggle="modal" data-target="#modal-edit-profile" title=""><span class="job-is ft">Cambiar nombre</span></a> -->


					 					<ul class="tags-jobs">
						 					<li><i class="la la-file-text"></i>Examenes Creados</li>
						 					<li><i class="la la-file-text"></i>Examenes Finalizados</li>
						 					<li><i class="la la-file-text"></i>Examenes Pendientes</li>
						 				</ul>
					 				</div>
					 			</div><!-- Job Head -->
			 					<!-- </div> -->
			 				</div>
			 			</div>
			 			<div class="job-wide-devider">
						 	<div class="row">
						 		<div class="recent-jobs">
					 				<h3 class="text-center">Exámenes</h3>
					 				<div class="job-list-modern">
									 	<div class="job-listings-sec no-border">


											@foreach($user->tests() as $test)
											<div class="job-listing wtabs noimg">
												<div class="job-title-sec">
													<h3><a href="#" title="">Web Designer / Developer</a></h3>
													<span>Massimo Artemisis</span>
													<div class="job-lctn"><i class="la la-map-marker"></i>Sacramento, California</div>
												</div>
												<div class="job-style-bx">
													<span class="job-is ft">Full time</span>
													
													<i>5 months ago</i>
												</div>
											</div>


											@endforeach

											<div class="job-listing wtabs noimg">
												<div class="job-title-sec">
													<h3><a href="#" title="">Categoría / Subcategoría</a></h3>
													<span>etiqueta1, etiqueta2, etiqueta,3</span>
													<div class="job-lctn"><i class="la la-map-marker"></i>Sacramento, California</div>
												</div>
												<div class="job-style-bx">
													<span class="job-is pt ">Finalizado</span>
													
													<i>5 months ago</i>
												</div>
											</div><!-- Job -->
										</div>
									 </div>
					 			</div>
						 	</div>
						</div>
				 	</div>
			 	</div>
			</div>
		</div>
	</div>
</section>
@endsection

@section('modals')
<div class="modal fade bd-example-modal" id="modal-edit-profile" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
	<div class="modal-content pt-4">
		<h3>Cambiar información del Pdf</h3>
		<button type="button" class="close-b" data-dismiss="modal" aria-label="Close">
			<span class="close-popup"><i class="la la-close"></i></span>
		</button>
		<div class="modal-body">
			<div class="contact-edit pl-5 pr-5">
				<div class="row">
					<div class="col-lg-12">
						<form id="form-information-pdf-edit" class="pl-1">
							@csrf
							<span class="pf-title">Nombre</span>									
							<div class="pf-field">
								<input type="text" name="name_pdf_edit" id="name_pdf_edit" maxlength="50" required>
								<span class="form-error" id="e_name_pdf" hidden> Debe agregar una cantidad válida</span>
							</div>
							<input type="hidden" id="talento_id_pdf_edit" name="talento_id_pdf_edit">
							<span class="pf-title">Descripción</span>									
							<div class="pf-field">
								<textarea id="description-pdf-edit" name="description-pdf-edit" required></textarea>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
		<div class="modal-footer">
			<button type="button" data-dismiss="modal" class="bbutton">Cerrar</button>
			<button type="button" class="bbutton" id="b-editar-pdf">Guardar</button>
		</div>
	</div>
  </div>
</div>
@endsection
