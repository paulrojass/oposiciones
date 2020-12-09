@extends('layouts.app')

@section('title', 'Respuestas')

@section('css')

@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Nueva respuesta para la pregunta: <strong>{{ $question->content }}</strong>
                    <a class="float-right" href="{{ route('preguntas') }}">volver a Preguntas</a>
                </div>

                <div class="card-body">
                    <form class="form-inline" method="POST" action="{{ route('agregar-respuesta') }}">
                        @csrf
                        <input type="hidden" name="question_id" id="question_id" value="{{ $question->id }}">
                        <div class="form-row align-items-center">
                            <div class="col-auto">
                                <label for="content" class="sr-only">Respuesta</label>
                                <input type="text" class="form-control @error('content') is-invalid @enderror" name="content" id="content" placeholder="respuesta" required autofocus>
                                @error('content')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            @php($correcta = 0)
                            @foreach ($answers as $answer)
                                @if($answer->correct == 1)
                                    @php($correcta = 1)
                                @endif
                            @endforeach
                            @if($correcta == 0)
                            <div class="col-auto">
                                  <div class="form-check mb-2">
                                    <input class="form-check-input" type="checkbox" id="correct" name="correct">
                                    <label class="form-check-label" for="correct">
                                      Correcta
                                    </label>
                                  </div>
                            </div>
                            @endif
                            <div class="col-auto">
                                <button type="submit" class="btn btn-primary mb-2">Agregar</button>
                            </div>
                        </div>
                    </form>
                    <table class="table table-striped">
                      <thead>
                        <tr>
                          <th style="width: 10%">id</th>
                          <th style="width: 60%">Etiqueta</th>
                          <th style="width: 10%">Correcta</th>
                          <th style="width: 20%">acciones</th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach ($answers as $answer)
                        <tr>
                            <th scope="row">{{ $answer->id }}</th>
                            <td>{{ $answer->content }}</td>
                            <td>
                            @if ($answer->correct)
                                Sí
                            @else
                                No
                            @endif
                            </td>
                            <td>
                                <a href="javascript:void(0)" data-toggle="modal" data-target="#exampleModal" data-content="{{ $answer->content }}" data-id="{{ $answer->id }}" >editar</a> |
                                <a href="{{ route('eliminar-respuesta', $answer->id) }}"  onclick="return confirm('¿Desea eleminar la respuesta?')">eliminar
                                </a>
                            </td>
                        </tr>
                        @endforeach
                      </tbody>
                    </table>
                    {{ $answers->links() }}
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Editar respuesta</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="POST" action="{{ route('actualizar-respuesta') }}">
                <div class="modal-body">
                    @csrf
                    <input type="hidden" id="id" name="id">
                    <div class="form-group">
                        <input type="text" maxlength="200" class="form-control @error('content') is-invalid @enderror" name="content" id="content" placeholder="respuesta" required autofocus>
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
            modal.find('#content').val(content)
            modal.find('#id').val(recipient)
        })  
    };
</script>
@endsection
