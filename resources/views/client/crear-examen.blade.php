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
	 						<span class="pf-title">Categorías</span>
	 						<div class="pf-field">
	 							<select data-placeholder="Por favor selecciona una subcategoría"
	 									class="chosen"
	 									id="select-categories"
	 									name="subcategory">
									<option value = "" selected>Selecciona una categoría</option>
									@foreach ($categories as $category)
										@foreach (auth()->user()->categories as $userCategory)
											@if($userCategory->id == $category->id)
												<option value="{{$category->id}}">{{$category->name}}</option>
											@endif
										@endforeach
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
	})

	$('#select-categories').change(function(){
		$('#questions-result').html('')

		var category_id = $(this).val()
		var _token = $("input[name='_token']").val()
		$.ajax({
			url: '/ajax-search-tags-list',
			type: 'post',
			data: {category_id: category_id, _token: _token}
		})
		.done(function(response) {
			$('#etiquetas').html(response)
		})
		.fail(function() {
			console.log("error")
		})
		.always(function() {
			console.log("complete")
		});
	});

	/*Busqueda en checkbox*/
	$('#etiquetas').on('click', '.checkbox-tag', function() {
		searchQuestions()
		notChecked()
	});

	$('#etiquetas').on('click', '#all-checked', function() {
		activeCheckboxes()
		searchQuestions()
	})

});

function searchQuestions(){
	var tag = [];
	$(".checkbox-tag:checked").each(function() {
        tag.push($(this).val())
    })
	$.ajax({
		url:'/ajax-search-questions?tag='+JSON.stringify(tag),
		type:'get',
		success:function(response){
			$('#questions-result').html('')
			$('#questions-result').html(response)
		}
	})
}

function activeCheckboxes(){
	if ($('#all-checked').is(':checked')){
		$('.checkbox-tag').prop('checked', true)
	}else{
		$('.checkbox-tag').prop('checked', false)
	}
}

function notChecked(){
	var numberNotChecked = $('.checkbox-tag:not(":checked")').length
	if(numberNotChecked == 0){
		$('#all-checked').prop('checked', true)
	}else{
		$('#all-checked').prop('checked', false)
	}
}

</script>
@endsection
