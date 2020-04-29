
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
							<label for="content">Formular pregunta</label>
							<textarea class="form-control @error('content') is-invalid @enderror" name="content" id="content" rows="2" required></textarea>
							@error('content')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
						</div>
						<p>Selecciona las etiquetas que indetifiquen la pregunta</p>
						@if($categories->count()>0)
						@foreach ($categories as $category)
						<ul class="list-group list-group-flush">
						  <li class="list-group-item"><h4>{{ $category->name }}</h4>
							@if($category->subcategories->count()>0)
							@foreach ($category->subcategories as $subcategory) 
							<dl class="row">
								<dt class="col-sm-3">{{ $subcategory->name }}</dt>
								<dd class="col-sm-9">
									@foreach ($subcategory->tags as $tag)
									<div class="form-check form-check-inline">
										<input class="form-check-input" type="checkbox" name="tag[{{$tag->id}}]" id="tag[{{$tag->id}}]" value="{{$tag->id}}">
										<label class="form-check-label" for="tag{{$tag->id}}">{{$tag->name}}</label>
									</div>                        
									@endforeach
								</dd>
							</dl>
							@endforeach
							@endif
						  </li>
						</ul>
						@endforeach
						@endif
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
					<th style="width: 5%">id</th>
					<th style="width: 40%">Pregunta</th>
					<th style="width: 25%">Respuestas</th>
					<th style="width: 15%">etiquetas</th>
					<th style="width: 15%">acciones</th>
				</tr>
			</thead>
			<tbody>
				@foreach ($questions as $question)
				<tr>
					<td scope="row">{{ $question->id }}</td>
					<td><em>{{ $question->content }}</em></td>
					<td>
						<ul class="list-group">
							@foreach ($question->answers as $answer)
							<li> @if ($answer->correct) <span class="badge badge-secondary">correcta</span> @endif {{ $answer->content }}</li>
							@endforeach
						</ul>
					</td>
					<td>
						@foreach ($question->tags as $tag)
							<span class="badge badge-success">{{ $tag->name }}</span>
						@endforeach
					</td>
					<td>
						<a href="{{ route('respuestas', $question->id) }}" >agregar_respuestas</a> |
						<a href="{{ route('preguntas-etiquetas', $question->id) }}" >agregar_etiquetas</a> |
						<a href="javascript:void(0)" data-toggle="modal" data-target="#exampleModal" data-content="{{ $question->content }}" data-id="{{ $question->id }}" >editar</a> |
						<a href="{{ route('eliminar-pregunta', $question->id) }}" onclick="return confirm('¿Desea eleminar la pregunta?')">eliminar</a>
					</td>
			    </tr>
				@endforeach
				</tbody>
			</table>
			{{ $questions->links() }}
		</div>
	</div>


<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Editar pregunta</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<form method="POST" action="{{ route('actualizar-pregunta') }}">
				<div class="modal-body">
					@csrf
					<input type="hidden" id="id" name="id">
					<div class="form-group">
						<!-- <label for="content">Formular prgunta</label> -->
						<textarea class="form-control" name="content" id="content" rows="2" required></textarea>
						@error('content')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror							
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">cancelar</button>
					<button type="submit" class="btn btn-primary">actualizar</button>
				</div>
			</form>
		</div>
	</div>
</div>

@endsection

@section('scripts')
<script>
    window.onload = function() {
        $('#content').focus();

		$('#exampleModal').on('show.bs.modal', function (event) {
			var a = $(event.relatedTarget) // Button that triggered the modal
			var recipient = a.data('id') // Extract info from data-* attributes
			var content = a.data('content') // Extract info from data-* attributes
			var modal = $(this)
			modal.find('.modal-body textarea').val(content)
			modal.find('#id').val(recipient)
		})
    };
</script>
@endsection
