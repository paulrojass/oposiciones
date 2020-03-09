@extends('layouts.app')

@section('title', 'Categorias')

@section('css')

@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Nueva Categoría</div>

                <div class="card-body">
                    <form class="form-inline" method="POST" action="{{ route('agregar-categoria') }}">
                        @csrf
                        <div class="form-row align-items-center">
                            <div class="col-auto">
                                <label for="name" class="sr-only">Nombre de Categoría</label>
                                <input type="text" maxlength="200" class="form-control" name="name" id="name" placeholder="Nombre de la categoria" required autofocus>
                            </div>
                            <div class="col-auto">
                                <button type="submit" class="btn btn-primary mb-2">Agregar</button>
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
              <th scope="col">Categorias</th>
              <th scope="col">etiquetas</th>
              <th scope="col">acciones</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($categories as $category)
            <tr>
                <th scope="row col-1">{{ $category->id }}</th>
                <td class="col-4">{{ $category->name }}</td>
                <td class="col-5">
                    @foreach ($category->tags as $tag)
                        <span class="badge badge-success">{{ $tag->name }}</span>
                    @endforeach
                </td>
                <td class="col-2">
                    <a href="{{ route('etiquetas', $category->id) }}" >nueva_etiqueta</a> |
                    <a href="{{ route('eliminar-categoria', $category->id) }}"  onclick="return confirm('¿Desea eleminar la categoria?')">eliminar</a>
                </td>
            </tr>
            @endforeach
          </tbody>
        </table>
        {{ $categories->links() }}
    </div>
</div>
@endsection

@section('scripts')

@endsection