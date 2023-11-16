@extends('layouts.app')
  
@section('title', 'Crear Proveedor')
  
@section('contents')
    <form action="{{ route('proveedores.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="col-md-6 mx-auto">
                <div>
                    <div class="card mb-4 mx-auto text-center">
                        <div class="demo-inline-spacing">
                            <button class="btn btn-primary">Guardar</button>
                            <a href="{{ route('proveedores') }}" class="btn btn-secondary">Volver</a>
                           
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
                    @if(Session::has('danger'))
                    <div class="alert alert-danger" role="alert">
                            {{ Session::get('danger') }}
                        </div>
                    @endif
                    <div class="card mb-4">
                        <h5 class="card-header">Datos</h5>
                        <div class="card-body">
                            <div class="mb-3">
                                <label for="exampleFormControlInput1" class="form-label">Nombre</label>
                                <input
                                type="text"
                                class="form-control"
                                id="nombre"
                                name="nombre"
                                placeholder="Textil SA"
                                value="{{ old('nombre') }}"
                                class="@error('nombre') is-invalid @enderror"
                                />
                            
                            </div>

                            <div class="mb-3">
                                <label for="exampleFormControlInput1" class="form-label">Contacto</label>
                                <input
                                type="text"
                                class="form-control"
                                id="contacto"
                                name="contacto"
                                placeholder="3704336655"
                                value="{{ old('contacto') }}"
                                class="@error('contacto') is-invalid @enderror"
                                />
                            
                            </div>

                            <div class="mb-3">
                                <label for="exampleFormControlInput1" class="form-label">Dirección</label>
                                <input
                                type="text"
                                class="form-control"
                                id="direccion"
                                name="direccion"
                                placeholder="Salta 1756"
                                value="{{ old('direccion') }}"
                                class="@error('direccion') is-invalid @enderror"
                                />
                            
                            </div>
                           
                            <div class="form-check mt-3">
                                <input class="form-check-input" type="checkbox" value="1" id="activo" name="activo" checked/>
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