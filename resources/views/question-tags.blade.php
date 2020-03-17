@extends('layouts.app')

@section('title', 'Etiquetas')

@section('css')

@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Nueva etiqueta para la pregunta: <strong>{{ $question->content }}</strong>
                    <a class="float-right" href="{{ route('preguntas') }}">volver a Preguntas</a>
                </div>

                <div class="card-body">

                    <form method="POST" action="{{ route('agregar-etiqueta-pregunta') }}">
                        <input type="hidden" name="id" id="id" value="{{ $question->id }}">
                        @csrf

                        @if($categories->count()>0)
                        <p>Selecciona las etiquetas que indetifiquen la pregunta</p>
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
                                        <input class="form-check-input" type="checkbox" name="tag[{{$tag->id}}]" id="tag[{{$tag->id}}]" value="{{$tag->id}}"
                                            @foreach ($tags as $seleccionado)
                                                @if($tag->id == $seleccionado->id)
                                                    checked 
                                                @endif
                                            @endforeach
                                            >
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
                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    agregar
                                </button>
                            </div>
                        </div>
                        @else
                        <p>Debe agregar Subcategorías y etiquetas para poder asignarlas a las preguntas</p>

                        <a href="{{ route('subcategorias') }}">Agregar Subcategorías y etiquetas</a>
                        @endif
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')

@endsection
