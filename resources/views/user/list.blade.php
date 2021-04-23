@extends('layouts.app')

@section('css')
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.css">
@endsection

@section('content')
    <div class="container-fluid">
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Usuarios</h3>
            </div><!-- /.card-header -->
            <div class="card-body">
                <div class="container">
                <!-- comienzo tabla -->
                    <table id="usuarios" class="table table-striped">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nombre</th>
                                <th>Apellido</th>
                                <th>Email</th>
                                <th>Contraseña</th>
                                <th width="100px">Acción</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($usuarios as $user)
                            <tr>
                                <td>{{$user->id}}</td>
                                <td>{{$user->name}}</td>
                                <td>{{$user->lastname}}</td>
                                <td>{{$user->email}}</td>
                                <td>
                                    <a href="#" class="btn btn-info" data-toggle="modal" data-target="#editPass{{$user->id}}">
                                       Cambiar contraseña</i>
                                    </a>
                                </td>
                                <td width="100px">
                                    <a href="#" class="btn btn-info" data-toggle="modal" data-target="#edit{{$user->id}}">
                                        <i class="nav-icon fas fa-edit"></i>
                                    </a>
                                    {{ Form::open( [ 'route' => ['user.destroy' , $user->id ], 'method' => 'DELETE' ] ) }}
                                    <button type="submit" class="btn btn-danger btn-block"><i class="nav-icon fas fa-ban"></i></button>
                                    {{ Form::close()}}
                                </td>
                            </tr>
                            <div class="modal fade" id="edit{{$user->id}}"><!-- /.Ventana emergente editar-->
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
                                            {{ Form::open( [ 'route' => ['user.update' , $user->id ], 'method' => 'PUT' ] ) }}
                                                @csrf
                                                <input name="id" type="hidden" value="{{$user->id}}">
                                                <div class="input-group mb-3">
                                                    <input type="text"
                                                           name="name"
                                                           value=" {{$user->name}}"
                                                           class="form-control @error('name') is-invalid @enderror"
                                                           placeholder="Nombre de usuario" required>
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
                                                           name="lastname"
                                                           value=" {{$user->lastname}}"
                                                           class="form-control @error('lastname') is-invalid @enderror"
                                                           placeholder="Dirección" required>
                                                    <div class="input-group-append">
                                                        <div class="input-group-text"><span class="fas fa-user"></span></div>
                                                    </div>
                                                    @error('lastname')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                    @enderror
                                                </div>
                                                <div class="input-group mb-3">
                                                    <input type="text"
                                                           name="email"
                                                           value=" {{$user->email}}"
                                                           class="form-control @error('email') is-invalid @enderror"
                                                           placeholder="Ciudad" required>
                                                    <div class="input-group-append">
                                                        <div class="input-group-text"><span class="fas fa-envelope"></span></div>
                                                    </div>
                                                    @error('email')
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
                            </div> <!-- /.Fin Ventana emergente editar-->
                            <div class="modal fade" id="editPass{{$user->id}}"><!-- /.Ventana emergente contraseña-->
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <div class="row">
                                                <div class="col-9">
                                                    <h4>Cambiar contraseña</h4>
                                                </div>
                                                <div class="col-3">
                                                    <button type="button" class="close" data-dismiss="modal">
                                                        <span>×</span>
                                                    </button>
                                                </div>
                                            </div>     
                                        </div>
                                        <div class="modal-body">
                                            {{ Form::open( [ 'route' => ['user.update' , $user->id ], 'method' => 'PUT' ] ) }}
                                                @csrf
                                                <input name="id" type="hidden" value="{{$user->id}}">
                                                <div class="input-group mb-3">
                                                    <input type="password"
                                                           name="password"
                                                           class="form-control @error('password') is-invalid @enderror"
                                                           placeholder="Password">
                                                    <div class="input-group-append">
                                                        <div class="input-group-text"><span class="fas fa-lock"></span></div>
                                                    </div>
                                                    @error('password')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                    @enderror
                                                </div>
                                                <div class="input-group mb-3">
                                                    <input type="password"
                                                           name="password_confirmation"
                                                           class="form-control"
                                                           placeholder="Retype password">
                                                    <div class="input-group-append">
                                                        <div class="input-group-text"><span class="fas fa-lock"></span></div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <!-- /.col -->
                                                    <div class="col-6">
                                                    </div>
                                                    <div class="col-6">
                                                        <button type="submit" class="btn btn-primary btn-block">Cambiar</button>
                                                    </div>
                                                    <!-- /.col -->
                                                </div>
                                            {{ Form::close()}}
                                        </div>
                                    </div>
                                </div>
                            </div> <!-- /.Fin Ventana emergente contraseña-->    
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
@endsection