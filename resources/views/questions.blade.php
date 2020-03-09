@extends('layouts.app')

@section('title', 'Preguntas')

@section('css')

@endsection

@section('content')
<div class="container">
	<div class="row justify-content-center">
		<div class="col-md-8">
			<div class="card">
				<div class="card-header">Nueva Pregunta</div>
				<div class="card-body">
					<form method="POST" action="{{ route('agregar-pregunta') }}">
						@csrf
						<div class="form-group row">
							<label for="content">Formular prgunta</label>
							<textarea class="form-control" name="content" id="content" rows="2" required></textarea>
						</div>
						@if($categories->count()>0)
						<p>Selecciona las etiquetas que indetifiquen la pregunta</p>
						@else
						<p>Debe agregar Categorías y etiquetas para poder asignarlas a las preguntas</p>
						@endif
						@foreach ($categories as $category) 
						<dl class="row">
							<dt class="col-sm-3">{{ $category->name }}</dt>
							<dd class="col-sm-9">
								@foreach ($category->tags as $tag)
								<div class="form-check form-check-inline">
									<input class="form-check-input" type="checkbox" name="tag[{{$tag->id}}]" id="tag[{{$tag->id}}]" value="{{$tag->id}}">
									<label class="form-check-label" for="tag{{$tag->id}}">{{$tag->name}}</label>
								</div>                        
								@endforeach
							</dd>
						</dl>
						@endforeach
						<div class="form-group row mb-0">
							<div class="col-md-8 offset-md-4">
								<button type="submit" class="btn btn-primary">
									agregar
								</button>
							</div>
						</div>
					</form>
				</div>               
			</div>
		</div>

		<table class="table table-striped">
			<thead>
				<tr>
					<th scope="col">id</th>
					<th scope="col">Pregunta</th>
					<th scope="col">Respuestas</th>
					<th scope="col">etiquetas</th>
					<th scope="col">acciones</th>
				</tr>
			</thead>
			<tbody>
				@foreach ($questions as $question)
				<tr>
					<th scope="row" class="col-1">{{ $question->id }}</th>
					<td class="col-4">{{ $question->content }}</td>
					<td class="col-3">
						<ul>
							@foreach ($question->answers as $answer)
							<li>{{ $answer->content }} @if ($answer->correct) (correcta) @endif</li>
							@endforeach
						</ul>
					</td>
					<td class="col-2">
						@foreach ($question->tags as $tag)
							<span class="badge badge-success">{{ $tag->name }}</span>
						@endforeach
					</td>
					<td class="col-2">
						<a href="{{ route('respuestas', $question->id) }}" >nueva_respuesta</a> |
						<a href="{{ route('eliminar-pregunta', $question->id) }}" onclick="return confirm('¿Desea eleminar la pregunta?')">eliminar</a></td>
					</tr>
					@endforeach
				</tbody>
			</table>
			{{ $questions->links() }}
		</div>
	</div>
	@endsection

	@section('scripts')

	@endsection