@extends('layouts.tema')
@section('title', 'Crear Examen')
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
							<div class="job-search-sec ">
								<div class="job-search ">
									<h3>Seleccione el contenido de su Examen</h3>
									<span>Al elegir las etiquetas de acuerdo a la categoría deseada, se realizara una busqueda de preguntas para crear un examen</span>
									<form method="POST" action="{{ route('resultados-busqueda') }}">
										@csrf
										<div class="row">
											<div class="col-lg-12 col-md-5 col-sm-12 col-xs-12">
												<div class="job-field">
													<select data-placeholder="City, province or region" class="chosen-city" id="select-subcategories" name="subcategory">
														<option value = "">Selecciona una subcategoría</option>
														@php($categoria = "")
														@foreach($subcategories as $subcategory)
														@if($subcategory->category->name != $categoria)
															@php($categoria = $subcategory->category->name)
																@if(!$loop->first)
																	</optgroup>
																@endif
																<optgroup label="{{$categoria}}">
																	<option value="{{$subcategory->id}}">{{$subcategory->name}}</option>
														@else
															<option value="{{$subcategory->id}}">{{$subcategory->name}}</option>
															@if($loop->last)
																</optgroup>
															@endif
														@endif
														@endforeach
													</select>
													<i class="la la-map-marker"></i>
												</div>
											</div>
											<div id="etiquetas">
												
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
	</section>
@endsection


@section('scripts')
<script>	
$(function(){
	$.ajaxSetup({
	    headers: {
	        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	    }
	});	
	$('#select-subcategories').change(function(){
		var subcategory_id = $(this).val();
		var _token = $("input[name='_token']").val();
		$.ajax({
			url: '/ajax-search-tags-list',
			type: 'post',
/*		contentType: false, // NEEDED, DON'T OMIT THIS (requires jQuery 1.6+)
		processData: false, // NEEDED, DON'T OMIT THIS	*/		
			data: {subcategory_id: subcategory_id, _token: _token}
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
})
</script>
@endsection