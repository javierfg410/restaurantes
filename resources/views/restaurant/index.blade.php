@extends('layouts.app')

@section('css')
<!-- codigo CSS para Datatables -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.css">
@endsection

@section('content')
    <div class="container-fluid">
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Restaurantes</h3>
                <div class="card-tools">
                </div><!-- /.card-tools -->
            </div><!-- /.card-header -->
            <div class="card-body">
                <div class="container">
                    <!-- Añadir restaurante deshabilitado para admin -->
                    @if(Auth::user()->id != 1)
                    <div class="row">
                        <div class="col-12">
                            <a href="#" class="btn btn-success" data-toggle="modal" data-target="#create">
                                Nuevo restaurante
                            </a>
                        </div>
                    </div>
                    @endif
                    <!-- comienzo tabla -->
                    <table id="restaurantes" class="table table-striped">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nombre</th>
                                <th>Dirección</th>
                                <th>Ciudad</th>
                                <th>Pais</th>
                                <th width="100px">Acción</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($restaurantes as $restaurante)
                            <tr>
                                <td>{{$restaurante->id_restaurant}}</td>
                                <td>
                                    <a href="/restaurants/{{$restaurante->id_restaurant}}" class="btn btn-link" >
                                        {{$restaurante->name}}
                                    </a>
                                </td>
                                <td>{{$restaurante->address}}</td>
                                <td>{{$restaurante->town}}</td>
                                <td>{{$restaurante->country}}</td>
                                <td width="100px">
                                    @if(Auth::user()->id == 1 || Auth::user()->id == $restaurante->id_user)
                                    <a href="#" class="btn btn-info btn-block" data-toggle="modal" data-target="#edit{{$restaurante->id_restaurant}}">
                                        <i class="nav-icon fas fa-edit"></i>
                                    </a>
                                    
                                    {{ Form::open( [ 'route' => ['restaurants.destroy' , $restaurante->id_restaurant ], 'method' => 'DELETE' ] ) }}
                                    <button type="submit" class="btn btn-danger btn-block"><i class="nav-icon fas fa-ban"></i></button>
                                    {{ Form::close()}}
                                    @endif
                                </td>
                            </tr>
                            <div class="modal fade" id="edit{{$restaurante->id_restaurant}}"><!-- /.Ventana emergente crear-->
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <div class="row">
                                                <div class="col-9">
                                                    <h4>Editar</h4>
                                                </div>
                                                <div class="col-3">
                                                    <button type="button" class="close" data-dismiss="modal">
                                                        <span>×</span>
                                                    </button>
                                                </div>
                                            </div>     
                                        </div>
                                        <div class="modal-body">
                                            {{ Form::open( [ 'route' => ['restaurants.update' , $restaurante->id_restaurant ], 'method' => 'PUT' ] ) }}
                                                @csrf
                                                <input name="id_restaurant" type="hidden" value="{{$restaurante->id_restaurant}}">
                                                <div class="input-group mb-3">
                                                    <input type="text"
                                                           name="name"
                                                           value=" {{$restaurante->name}}"
                                                           class="form-control @error('name') is-invalid @enderror"
                                                           placeholder="Nombre del restaurante" required>
                                                    <div class="input-group-append">
                                                        <div class="input-group-text"><span class="fas fa-user"></span></div>
                                                    </div>
                                                    @error('name')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                    @enderror
                                                </div>
                                                <div class="input-group mb-3">
                                                    <input type="text"
                                                           name="address"
                                                           value=" {{$restaurante->address}}"
                                                           class="form-control @error('address') is-invalid @enderror"
                                                           placeholder="Dirección" required>
                                                    <div class="input-group-append">
                                                        <div class="input-group-text"><span class="fas fa-user"></span></div>
                                                    </div>
                                                    @error('address')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                    @enderror
                                                </div>
                                                <div class="input-group mb-3">
                                                    <input type="text"
                                                           name="town"
                                                           value=" {{$restaurante->town}}"
                                                           class="form-control @error('town') is-invalid @enderror"
                                                           placeholder="Ciudad" required>
                                                    <div class="input-group-append">
                                                        <div class="input-group-text"><span class="fas fa-envelope"></span></div>
                                                    </div>
                                                    @error('town')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                    @enderror
                                                </div>
                                                <div class="input-group mb-3">
                                                    <input type="text"
                                                           name="country"
                                                           value=" {{$restaurante->country}}"
                                                           class="form-control @error('town') is-invalid @enderror"
                                                           placeholder="País" required>
                                                    <div class="input-group-append">
                                                        <div class="input-group-text"><span class="fas fa-envelope"></span></div>
                                                    </div>
                                                    @error('country')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                    @enderror
                                                </div>
                                
                                                <div class="row">
                                                    <!-- /.col -->
                                                    <div class="col-6">
                                                    </div>
                                                    <div class="col-6">
                                                        <button type="submit" class="btn btn-primary btn-block">Guardar</button>
                                                    </div>
                                                    <!-- /.col -->
                                                </div>
                                            {{ Form::close()}}
                                        </div>
                                    </div>
                                </div>
                            </div> <!-- /.Fin Ventana emergente -->  
                            @endforeach
                        </tbody>
                    </table>
                    @section('js')
                    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
                    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.js" defer></script>
              

                    <script>
                        $(document).ready(function() {
                            $('#restaurantes').DataTable({
                                language: {
                                    "decimal": "",
                                    "emptyTable": "No hay información",
                                    "info": "Mostrando _START_ a _END_ de _TOTAL_ Entradas",
                                    "infoEmpty": "Mostrando 0 to 0 of 0 Entradas",
                                    "infoFiltered": "(Filtrado de _MAX_ total entradas)",
                                    "infoPostFix": "",
                                    "thousands": ",",
                                    "lengthMenu": "Mostrar _MENU_ Entradas",
                                    "loadingRecords": "Cargando...",
                                    "processing": "Procesando...",
                                    "search": "Buscar:",
                                    "zeroRecords": "Sin resultados encontrados",
                                    "paginate": {
                                        "first": "Primero",
                                        "last": "Ultimo",
                                        "next": "Siguiente",
                                        "previous": "Anterior"
                                    }
                                }
                            });
                        } );
                    </script>
                    @endsection
                </div><!-- fin tabla -->
            </div><!-- /.card-body -->
        </div><!-- /.card -->
    </div>
    <div class="modal fade" id="create"><!-- /.Ventana emergente crear-->
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <div class="row">
                        <div class="col-9">
                            <h4>Crear</h4>
                        </div>
                        <div class="col-3">
                            <button type="button" class="close" data-dismiss="modal">
                                <span>×</span>
                            </button>
                        </div>
                    </div>     
                </div>
                <div class="modal-body">
                    <form method="post" action="/restaurants">
                        @csrf
        
                        <div class="input-group mb-3">
                            <input type="text"
                                   name="name"
                                   class="form-control @error('name') is-invalid @enderror"
                                   placeholder="Nombre del restaurante" required>
                            <div class="input-group-append">
                                <div class="input-group-text"><span class="fas fa-user"></span></div>
                            </div>
                            @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="input-group mb-3">
                            <input type="text"
                                   name="address"
                                   class="form-control @error('address') is-invalid @enderror"
                                   placeholder="Dirección" required>
                            <div class="input-group-append">
                                <div class="input-group-text"><span class="fas fa-user"></span></div>
                            </div>
                            @error('address')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="input-group mb-3">
                            <input type="text"
                                   name="town"
                                   class="form-control @error('town') is-invalid @enderror"
                                   placeholder="Ciudad" required>
                            <div class="input-group-append">
                                <div class="input-group-text"><span class="fas fa-envelope"></span></div>
                            </div>
                            @error('town')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="input-group mb-3">
                            <input type="text"
                                   name="country"
                                   class="form-control @error('town') is-invalid @enderror"
                                   placeholder="País" required>
                            <div class="input-group-append">
                                <div class="input-group-text"><span class="fas fa-envelope"></span></div>
                            </div>
                            @error('country')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
        
                        <div class="row">
                            <!-- /.col -->
                            <div class="col-6">
                            </div>
                            <div class="col-6">
                                <button type="submit" class="btn btn-primary btn-block">Guardar</button>
                            </div>
                            <!-- /.col -->
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div> <!-- /.Fin Ventana emergente -->   
 
@endsection