@extends('layouts.app')

@section('title', 'Etiquetas')

@section('css')

@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Nueva etiequeta para <strong>{{ $category->name }}</strong>
                    <a class="float-right" href="{{ route('categorias') }}">volver a Categorias</a>
                </div>

                <div class="card-body">
                    <form class="form-inline" method="POST" action="{{ route('agregar-etiqueta') }}">
                        @csrf
                        <input type="hidden" name="category_id" id="category_id" value="{{ $category->id }}">
                        <div class="form-row align-items-center">
                            <div class="col-auto">
                                <label for="name" class="sr-only">Nombre de Etiqueta</label>
                                <input type="text" maxlength="200" class="form-control" name="name" id="name" placeholder="Nombre de la etiqueta" required autofocus>
                            </div>
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
                          <th scope="col">acciones</th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach ($tags as $tag)
                        <tr>
                            <th scope="row">{{ $tag->id }}</th>
                            <td class="col-8">{{ $tag->name }}</td>
                            <td>
                                <a href="{{ route('eliminar-etiqueta', $tag->id) }}"  onclick="return confirm('¿Desea eleminar la etiqueta?')">eliminar</a>
                            </td>
                        </tr>
                        @endforeach
                      </tbody>
                    </table>
                    {{ $tags->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')

@endsection
