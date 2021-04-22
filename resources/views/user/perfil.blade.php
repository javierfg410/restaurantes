@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <h1 class="text-black-50">{{Auth::user()->name}} {{Auth::user()->lastname}}</h1>
        <div class="card">
            <div class="card-body register-card-body">
                <p class="login-box-msg">Editar los datos de Usuario</p>
    
                <form method="post" action="/setUser">
                    @csrf
    
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
                        <!-- /.col -->
                        <div class="col-6">
                            <a href="/delUser" class="btn btn-danger btn-block">Eliminar</a>
                        </div>
                        <div class="col-6">
                            <button type="submit" class="btn btn-primary btn-block">Editar</button>
                        </div>
                        <!-- /.col -->
                    </div>
                </form>
            </div>
            <!-- /.form-box -->
        </div><!-- /.card -->
    </div>
@endsection