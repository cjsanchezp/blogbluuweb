@extends('plantilla')

@section('seccion')
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

    <title>Hello, world!</title>
  </head>
  <body>   
    <div class="container my4">
        <h1 class="display-4">Notas</h1>
        @if (session('mensaje'))
            <div class="alert alert-success">
              {{session('mensaje')}}
            </div>            
        @endif
        <form action="{{route('notas.crear')}}" method="POST">
          @csrf

          @error('nombre')
              <div class="alert alert-danger">
                El nombre es obligatorio
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
          @enderror

          @error('descripcion')
              <div class="alert alert-danger">
                La descripcion es obligatorio
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
          @enderror
          <input type="text" name="nombre" placeholder="Nombre" class="form-control mb-2" value="{{old('nombre')}}">
          <input type="text" name="descripcion" placeholder="Descripcion" class="form-control mb-2" value="{{old('descripcion')}}">
          <button class="btn btn-primary btn-block" type="submit">Agregar</button>
        </form>
        <table class="table">
          <thead>
            <tr>
              <th scope="col">#id</th>
              <th scope="col">Nombres</th>
              <th scope="col">Descripción</th>
              <th scope="col">Acciones</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($notas as $item)
            <tr>
              <th scope="row">{{$item->id}}</th>
              <td>
                  <a href="{{route('notas.detalle',$item)}}">
                    {{$item->nombre}}
                  </a>
              </td>
              <td>{{$item->descripcion}}</td>
              <td>
                <a href="{{route('notas.editar',$item)}}" class="btn btn-warning btn-sm">Editar</a>
                  <form action="{{route('notas.eliminar',$item)}}" method="POST" class="d-inline">
                    @method('DELETE')
                    @csrf
                    <button class="btn btn-danger btn-sm" type="submit">Eliminar</button>
                  </form>

              </td>
            </tr> 
            @endforeach()                      
          </tbody>
        </table>
    </div>

    
  </body>
</html>
    {{$notas->links()}}
@endsection

