@extends('layouts.app')
  
@section('title', 'Editar Empresa')
  
@section('contents')
    <form action="{{ route('empresas.update', $empresa->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="row">
            <div class="col-md-6 mx-auto">
                <div>
                    <div class="card mb-4 mx-auto text-center">
                        <div class="demo-inline-spacing">
                            <button class="btn btn-primary">Guardar</button>
                            @if(Auth::user()->root == 1)
                                <a href="{{ route('empresas') }}" class="btn btn-secondary">Volver</a>
                            @endif
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
                    @if(Session::has('success'))
                    <div class="alert alert-success" role="alert">
                            {{ Session::get('success') }}
                        </div>
                    @endif
                    <div class="card mb-4">
                        <h5 class="card-header">Datos</h5>
                        <div class="card-body">
                            <div class="mb-3">
                                <label for="exampleFormControlInput1" class="form-label">Descripción</label>
                                <input
                                type="text"
                                class="form-control"
                                id="descripcion"
                                name="descripcion"
                                placeholder="La Cocina"
                                value="{{ $empresa->descripcion }}"
                                class="@error('descripcion') is-invalid @enderror"
                                />
                            
                            </div>
                            <div class="mb-3">
                                <label for="exampleFormControlInput1" class="form-label">Dirección</label>
                                <input
                                type="text"
                                class="form-control"
                                id="direccion"
                                name="direccion"
                                value="{{ $empresa->direccion }}"
                                placeholder="Eva Peron 2736"
                                />
                            </div>
                            
                           
                                <div class="form-check mt-3">
                                    <input class="form-check-input"  @if(Auth::user()->root !== 1) disabled @endif type="checkbox" value="1" {{ $empresa->admin == 1 ? 'checked' : '' }}  id="admin" name="admin" />
                                    <label class="form-check-label" for="defaultCheck1"> Administrador </label>
                                </div>

                                <div class="form-check mt-3">
                                    <input class="form-check-input" @if(Auth::user()->root !== 1) disabled @endif type="checkbox" value="1" {{ $empresa->activo == 1 ? 'checked' : '' }}  id="activo" name="activo" />
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