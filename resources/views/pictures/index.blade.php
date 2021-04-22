@extends('layouts.app')

@section('css')
<style>
    .container {
      position: relative;
      width: 50%;
    }
    
    .image {
      opacity: 1;
      display: block;
      width: 100%;
      height: auto;
      transition: .5s ease;
      backface-visibility: hidden;
    }
    
    .middle {
      transition: .5s ease;
      opacity: 0;
      position: absolute;
      top: 50%;
      left: 50%;
      transform: translate(-50%, -50%);
      -ms-transform: translate(-50%, -50%);
      text-align: center;
    }
    
    .container:hover>.image {
      opacity: 0.3;
    }
    
    .container:hover>.middle {
      opacity: 1;
    }
    
    .text {
      background-color: #c73838;
      color: white;
      font-size: 16px;
      padding: 16px 32px;
    }
    </style>
    
@endsection

@section('content')
    <div class="container-fluid">
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Restaurante {{$restaurant->name}}</h3>
                <div class="card-tools">

                </div><!-- /.card-tools -->
            </div><!-- /.card-header -->
            <div class="card-body">
                <div class="container">
                    <div class="row">
                        <div class="col-12">
                            <a href="#" class="btn btn-success" data-toggle="modal" data-target="#create">
                                Nueva imagen
                            </a>
                        </div>
                    </div>
                    <div class="row">
                        @foreach ($pictures as $picture)
                        <div class="container">
                            <img src="{{ asset($picture->path)}}" alt="{{$picture->url}}" width="304" class="image">
                            <div class="middle">
                                <a class="text" href="/delPict/{{$picture->id_picture}}">
                                    <i class="nav-icon fas fa-ban"></i>
                                </a>
                            </div>
                        </div>
                        @endforeach

                    </div>
            </div><!-- /.card-body -->
        </div><!-- /.card -->
    </div>
    <div class="modal fade" id="create"><!-- /.Ventana emergente -->
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
                    <form method="post" enctype="multipart/form-data"  action="/addPict">
                        @csrf
                        <input name="id_restaurant" type="hidden" value="{{$restaurant->id_restaurant}}">
                        <div class="input-group mb-3">
                            <input type="file"
                                   name="urlfoto"
                                   class="form-control @error('urlfoto') is-invalid @enderror"
                                   required>
                            <div class="input-group-append">
                                <div class="input-group-text"><span class="fas fa-user"></span></div>
                            </div>
                            @error('name')
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