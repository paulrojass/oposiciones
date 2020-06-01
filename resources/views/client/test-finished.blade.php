@extends('layouts.tema')

@section('title', 'Resultado de examen')

@section('header_type', 'stick-top')

@section('content')
<section>
	<div class="block no-padding">
		<div class="container fluid">
			<div class="row">
				<div class="col-lg-12">
					<div class="main-featured-sec">
						<div class="new-slide">
							<img src="http://placehold.it/1920x800" alt="" />
						</div>
						<div class="job-search-sec">
							<div class="job-search">
								<h3>Calificación final: {{ $result }} %</h3>
								<span>Verifique las respuestas a continuación</span>
							</div>
						</div>
						<div class="scroll-to">
							<a href="#scroll-here" title=""><i class="la la-arrow-down"></i></a>
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
				@foreach ($questions as $question)
			 		<div class="bloglist-sec">
			 			<div class="blogpost style2">
			 				<div class="blog-postdetail">
			 					<h3 class="mb-4">{{ $loop->iteration }}. - {{ $question->content }}</h3>
			 					<p style="color:green"><strong>Respuesta correcta: </strong>{{ $correct[$loop->iteration - 1]->content }}</p>
								@if(($answers[$loop->iteration - 1]->content) !== ($correct[$loop->iteration - 1]->content))
			 					<p style="color:red"><strong >Su Respuesta: </strong>{{ $answers[$loop->iteration - 1]->content }}</p>


								@endif

			 				</div>
			 			</div>
			 		</div>
				@endforeach
			</div>
		</div>
	</div>
</section>
@endsection
