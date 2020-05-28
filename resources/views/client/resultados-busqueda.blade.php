@extends('layouts.tema')
@section('title', 'Resultado de la busqueda')
@section('header_type', 'stick-top forsticky')

@section('content')
	<section>
		<div class="block no-padding">
			<div class="container fluid">
				<div class="row">
					<div class="col-lg-12">
						<div class="main-featured-sec">
							<div class="new-slide-2">
								{{-- <img src="http://placehold.it/1920x800" alt="" /> --}}
								<img src="" alt="" />
							</div>

							@if($questions->count() >= 20)
							<div class="job-search-sec ">
								<div class="job-search ">
									<h3>{{ $questions->count() }} Preguntas encontradas</h3>
									<span>La busqueda arrojó la cantidad de preguntas necesarias para un examen, si desea comenzarlo haga clic en el siguiente enlace</span>
								</div>
								<div class="simple-text-block">
									<a href="{{ route('examen', ['questions' => $questions]) }}" title="">Iniciar Examen</a>
								</div>
							</div>
							@else
							<div class="job-search-sec ">
								<div class="job-search ">
									<h3>Busqueda sin resultados</h3>
									<span>Las etiquetas seleccionadas no tienen una cantidad de preguntas necesarias para realizar un examen por favor intente con otra búsqueda</span>
								</div>
								<div class="simple-text-block">
									<a href="{{ route('crear-examen') }}" title="">Volver a buscar</a>
								</div>
							</div>
							@endif
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
@endsection


@section('scripts')
<script>	
	$('#select-subcategories').change(function(){
		alert('cambio')
		var subcategory_id = 1
		$.ajax({
			url: '/ajax-search-tags-list',
			type: 'POST',
			data: {subcategory_id: subcategory_id},
		})
		.done(function(response) {
			$('#etiquetas').html(response);
		})
		.fail(function() {
			console.log("error");
		})
		.always(function() {
			console.log("complete");
		});
		
	});
$(function(){

})
</script>
@endsection