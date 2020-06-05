@extends('layouts.tema')

@section('title', 'Examen')

@section('header_type', 'gradient')

@php
	$tags = $test->tags;
	$tags_array = explode(",", $tags);
	$tags = App\Tag::find($tags_array);
@endphp

@section('content')
<section>
	<div class="block no-padding  gray">
		<div class="container">
			<div class="row">
				<div class="col-lg-12">
					<div class="inner2">
						<div class="inner-title2">
							<h3>Examen</h3>
							<span>
								<strong>Categoría:</strong> {{ $tags[0]->subcategory->category->name }} /
								<strong>Subcategoría:</strong> {{ $tags[0]->subcategory->name }} 
							</span>
							<span>
								<strong>Creado: </strong> {{ $test->created_at->diffForHumans() }} - 
								<strong>Actualizado: </strong>	{{ $test->updated_at->diffForHumans() }}
							</span>
							<span><strong>Cantidad de preguntas: </strong>{{ $questions->count() }}</span>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
<form method="POST" action="{{ route('save-test') }}" >
<section>
	<div class="block">
		<div class="container">
			<div class="row">
				@csrf
				<input type="hidden" name="test_id" value="{{ $test->id }}">
				<input type="hidden" name="value" value="{{ $questions->count() }}">
			 	<div class="col-lg-12 column">
					@foreach ($questions as $question)
						@php
						$iteracion = $loop->iteration;
						@endphp
				 		<div class="bloglist-sec">
				 			<div class="blogpost style2">
				 				<div class="blog-postdetail">
				 					<h3 class="mb-4">{{ $iteracion }}. - {{ $question->content }}</h3>
									@if($answers[$iteracion - 1] != 0 )
										@php
										$seleccionada = $question->answers->where('id', $answers[$iteracion - 1])->first();
										/*dd($seleccionada);*/
										if($seleccionada->correct == 1){
											$incorrectas = $question->answers->where('correct',0)->where('id','<>',$seleccionada->id)->random(3);
											$answers2 = $incorrectas->push($seleccionada);
										}else{
											$correcta = $question->answers->where('correct',1);
											$incorrectas = $question->answers->where('correct',0)->where('id','<>',$seleccionada->id)->random(2);
											$answers2 = $incorrectas->merge($correcta);
											$answers2 = $answers2->push($seleccionada);
										}
										@endphp
									@else
										@php
										$correcta = $question->answers->where('correct',1);
										$incorrectas = $question->answers->where('correct',0)->random(3);
										$answers2 = $incorrectas->merge($correcta);
										@endphp
									@endif
									@foreach($answers2->shuffle() as $answer)

										@php			
											$marcada =	in_array($answer->id, $answers);									
										@endphp
										<div class="mt-3">
										<input type="radio" name="answer[{{ $iteracion }}]" id="{{ $answer->id }}" value="{{ $answer->id }}" @if($marcada) checked @endif><label for="{{ $answer->id }}">{{ $answer->content }}</label><br />
										</div>
									@endforeach
				 				</div>
				 			</div>
				 		</div>
					@endforeach
			 	</div>

			 	<div id="boton-modal" class="col-lg-12 column">
					<div class="browse-all-cat mt-0">
						<button class="examen-button m-4" type="button" data-toggle="modal" data-target="#modal-save-test" >Guardar progreso</button>
					</div> 		
			 	</div>
			 	<div id="boton-finished" class="col-lg-12 column">
					<div class="browse-all-cat mt-0">
						<button class="examen-button m-4" type="submit" >finalizar</button>
					</div> 		
			 	</div>

			</div>
		</div>
	</div>
</section>

<div class="modal fade bd-example" id="modal-save-test" tabindex="0" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content pt-4">
			<button type="button" class="close-b" data-dismiss="modal" aria-label="Close">
				<span class="close-popup"><i class="la la-close"></i></span>
			</button>
			<div class="modal-body text-center">
				<input type="hidden" id="m-eliminar-talento">
				<p>Todavía no ha finalizado el examen, ¿desea contiuar o guardar y salir?</p>

			 	<div class="col-lg-12 column">
					<div class="browse-all-cat mt-0">
						<button class="examen-button m-4" type="button" data-dismiss="modal" aria-label="Close">Continuar</button>
						<button class="examen-button m-4" type="submit">Guardar y salir</button>
					</div> 		
			 	</div>
			</div>
		</div>
	</div>
</div>
</form>
@endsection


@section('scripts')
<script>
	$(function(){
		$('#boton-finished').hide();
	});



	var cantidad = '{{ $questions->count() }}';
    var $checkboxes = $('input[type="radio"]');
        
    $checkboxes.change(function(){
        var countCheckedCheckboxes = $checkboxes.filter(':checked').length;
        if(countCheckedCheckboxes == cantidad){
        	$('#boton-finished').show();
        	$('#boton-modal').hide();
        }else{
        	$('#boton-finished').hide();
        	$('#boton-modal').show();        	
        }
    });
</script>
@endsection