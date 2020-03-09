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
                                <input type="text" maxlength="200" class="form-control" name="content" id="content" placeholder="respuesta" required autofocus>
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
                          <th scope="col">id</th>
                          <th scope="col">Etiqueta</th>
                          <th scope="col">Correcta</th>
                          <th scope="col">acciones</th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach ($answers as $anwser)
                        <tr>
                            <th scope="row">{{ $anwser->id }}</th>
                            <td class="col-8">{{ $anwser->content }}</td>
                            <td class="col-8">
                            @if ($anwser->correct)
                                Sí
                            @else
                                No
                            @endif
                            </td>
                            <td>
                                <a href="{{ route('eliminar-respuesta', $anwser->id) }}"  onclick="return confirm('¿Desea eleminar la respuesta?')">eliminar
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
@endsection

@section('scripts')

@endsection
