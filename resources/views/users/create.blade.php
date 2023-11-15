@extends('layouts.app')
  
@section('title', 'Crear Usuario')
  
@section('contents')
    <form action="{{ route('users.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="col-md-6 mx-auto">
                <div>
                    <div class="card mb-4 mx-auto text-center">
                        <div class="demo-inline-spacing">
                            <button class="btn btn-primary">Guardar</button>
                            <a href="{{ route('users') }}" class="btn btn-secondary">Volver</a>
                           
                        </div>
                        <br>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6 mx-auto">
                <div>
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <div class="card mb-4">
                        <h5 class="card-header">Datos</h5>
                        <div class="card-body">
                            <div class="mb-3">
                                <label for="name" class="form-label">Nombre completo</label>
                                <input
                                    type="text"
                                    class="form-control"
                                    id="name"
                                    name="name"
                                    value="{{ old('name') }}"
                                    placeholder="Introduce tu nombre completo"
                                    autofocus
                                />
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="text" class="form-control" id="email" name="email" value="{{ old('email') }}" placeholder="Introduce tu correo electrónico" />
                            </div>
                            <div class="mb-3 form-password-toggle">
                                <label class="form-label" for="password">Password</label>
                            <div class="input-group input-group-merge">
                                <input
                                type="password"
                                id="password"
                                class="form-control"
                                name="password"
                                placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                                aria-describedby="password"
                                />
                                <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
                            </div>
                            </div>
                            <div class="mb-3">
                                <label for="exampleFormControlSelect1" class="form-label">Empresa</label>
                                <select class="form-select" id="empresa_id" name="empresa_id" aria-label="Default select example">
                                    @if(Auth::user()->root == 1)
                                        @foreach($empresas as $id => $descripcion)
                                            <option value="{{ $id }}" {{ old('empresa_id') == $id ? 'selected' : '' }}>{{ $descripcion }}</option>
                                        @endforeach
                                    @else
                                        <option value="{{ Auth::user()->empresa->id }}" {{ old('empresa_id') == Auth::user()->empresa->id ? 'selected' : '' }}>{{ Auth::user()->empresa->descripcion }}</option>
                                    @endif
                                </select>
                            </div>
                            @if(Auth::user()->root == 1)
                                <div class="form-check mt-3">
                                    <input class="form-check-input" type="checkbox" value="1" id="root" name="root" />
                                    <label class="form-check-label" for="defaultCheck1"> Root </label>
                                </div>
                            @endif
                            <div class="form-check mt-3">
                                <input class="form-check-input" type="checkbox" value="1" id="activo" name="activo" />
                                <label class="form-check-label" for="defaultCheck1"> Activo </label>
                            </div>

                            
                            <br>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
    </form>
@endsection