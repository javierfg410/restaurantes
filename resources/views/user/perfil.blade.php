@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <h1 class="text-black-50">{{Auth::user()->name}} {{Auth::user()->lastname}}</h1>
        <div class="card">
            <div class="card-body register-card-body">
                <p class="login-box-msg">Editar los datos de Usuario</p>
                {{ Form::open( [ 'route' => ['user.update' , Auth::user() -> id ], 'method' => 'PUT' ] ) }}
                    @csrf
                    <input name="id" type="hidden" value="{{Auth::user()->id}}">
                    <div class="input-group mb-3">
                        <input type="text"
                               name="name"
                               class="form-control @error('name') is-invalid @enderror"
                               value="{{ Auth::user()->name }}"
                               placeholder="Full name">
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
                               class="form-control @error('lastname') is-invalid @enderror"
                               value="{{ Auth::user()->lastname }}"
                               placeholder="Full lastname">
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
                        <input type="email"
                               name="email"
                               value="{{ Auth::user()->email }}"
                               class="form-control @error('email') is-invalid @enderror"
                               placeholder="Email">
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
                        <div class="col-12">
                            <a href="#" class="btn btn-info" data-toggle="modal" data-target="#editPass">
                                Cambiar contraseña</i>
                             </a>
                        </div>
                    </div>
                    <div class="modal fade" id="editPass"><!-- /.Ventana emergente contraseña-->
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
                                    {{ Form::open( [ 'route' => ['user.update' , Auth::user() -> id ], 'method' => 'PUT' ] ) }}
                                        @csrf
                                        <input name="id" type="hidden" value="{{Auth::user()->id}}">

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
                    <div class="row">
                        <!-- /.col -->
                        <div class="col-6"> 
                            {{ Form::open( [ 'route' => ['user.destroy' , Auth::user() -> id ], 'method' => 'DELETE' ] ) }}
                            <button type="submit" class="btn btn-danger btn-block">Eliminar</button>
                            {{ Form::close()}}
                        </div>
                        <div class="col-6">
                            <button type="submit" class="btn btn-primary btn-block" onclick= "document.forms[1].submit();">Editar</button>
                        </div>
                        <!-- /.col -->
                    </div>
                {{ Form::close()}}
            </div>
            <!-- /.form-box -->
        </div><!-- /.card -->
    </div>
@endsection