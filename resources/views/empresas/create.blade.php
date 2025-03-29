@extends('layouts.app')
  
@section('title', 'Crear Empresa')
  
@section('contents')
    <form action="{{ route('empresas.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="col-md-6 mx-auto">
                <div>
                    <div class="card mb-4 mx-auto text-center">
                        <div class="demo-inline-spacing">
                            <button class="btn btn-primary">Guardar</button>
                            <a href="{{ route('empresas') }}" class="btn btn-secondary">Volver</a>
                           
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
                                <label for="exampleFormControlInput1" class="form-label">Descripción</label>
                                <input
                                type="text"
                                class="form-control"
                                id="descripcion"
                                name="descripcion"
                                placeholder="La Cocina"
                                value="{{ old('descripcion') }}"
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
                                placeholder="Eva Peron 2736"
                                />
                            </div>

                            <div class="form-check mt-3">
                                <input class="form-check-input" type="checkbox" value="1" id="admin" name="admin" />
                                <label class="form-check-label" for="defaultCheck1"> Administrador </label>
                            </div>

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