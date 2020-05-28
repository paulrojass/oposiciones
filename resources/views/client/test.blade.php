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
<section>
	<div class="block">
		<div class="container">
			<div class="row">
			 	<div class="col-lg-12 column">
					@foreach ($questions as $question)
				 		<div class="bloglist-sec">
				 			<div class="blogpost style2">
				 				<div class="blog-postdetail">
				 					<h3 class="mb-4">{{ $loop->iteration }}. - {{ $question->content }}</h3>
									@php
										$correcta = $question->answers->where('correct',1);
										$incorrectas = $question->answers->where('correct',0)->random(4);
										$answers = $incorrectas->merge($correcta);
									@endphp

									@foreach($answers->shuffle() as $answer)
										<div class="mt-3">
										<input type="radio" name="{{ $question->id }}" id="{{ $answer->id }}"><label for="{{ $answer->id }}">{{ $answer->content }}</label><br />
										</div>
									@endforeach
				 				</div>
				 			</div>
				 		</div>
					@endforeach
			 	</div>
			 	<div class="col-lg-12 column">
					<div class="browse-all-cat mt-0">
						<button class="examen-button m-4" type="button">Cancelar</button>

						<button class="examen-button m-4" type="button">Guardar</button>

						<button class="examen-button m-4" type="submit">Finalizar</button>
					</div> 		
			 	</div>
			</div>
		</div>
	</div>
</section>
@endsection
