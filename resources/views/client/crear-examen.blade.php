@extends('layouts.tema')

@section('title', 'Crear Examen')

@section('header_type', 'gradient')

@section('content')
<section style="min-height: 600px">
<form method="POST" action="{{ route('new-test') }}">
	<div class="block no-padding">
		<div class="container">
			 <div class="row no-gape">
			 	<aside class="col-lg-6 column border-right">
						@csrf
	 					<div class="widget">
	 						<span class="pf-title">Categorías y Subcategorías</span>
	 						<div class="pf-field">
	 							<select data-placeholder="Por favor selecciona una subcategoría"
	 									class="chosen"
	 									id="select-subcategories"
	 									name="subcategory">
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
	 						</div>
	 					</div>
				 		<div class="widget" id="etiquetas">
						{{-- AQUI SE CARGAN LAS ETIQUETAS DINAMICAMENTE --}}
				 		</div>
			 	</aside>
			 	<div class="col-lg-6 column" id="questions-result">
					{{-- AQUI SE CARGA EL RESULTADO DE LA BUSQUEDA DE PREGUNTAS --}}
				</div>
			 </div>
		</div>
	</div>
</form>
</section>
@endsection


@section('scripts')

<script src="{{ asset('tema/js/jquery.scrollbar.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('tema/js/rslider.js') }}" type="text/javascript"></script>


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
		/*
 		contentType: false, // NEEDED, DON'T OMIT THIS (requires jQuery 1.6+)
		processData: false, // NEEDED, DON'T OMIT THIS
		*/		
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

	/*Busqueda en checkbox*/
	$('#etiquetas').on('click', 'input:checkbox', function() {
		searchQuestions();
	});
});

function searchQuestions(){
	var tag = [];
	$(".checkbox-tag:checked").each(function() {
        tag.push($(this).val());
    });
	$.ajax({
		url:'/ajax-search-questions?tag='+JSON.stringify(tag),
		type:'get',
		success:function(response){
			$('#questions-result').html('');
			$('#questions-result').html(response);
		}
	});

}
</script>
@endsection