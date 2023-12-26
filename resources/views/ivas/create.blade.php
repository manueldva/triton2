@extends('layouts.app')
  
@section('title', 'Crear IVA')
  
@section('contents')
    <form action="{{ route('ivas.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="col-md-6 mx-auto">
                <div>
                    <div class="card mb-4 mx-auto text-center">
                        <div class="demo-inline-spacing">
                            <button class="btn btn-primary">Guardar</button>
                            <a href="{{ route('ivas') }}" class="btn btn-secondary">Volver</a>
                           
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
                                <label for="exampleFormControlInput1" class="form-label">Descripción</label>
                                <input
                                type="text"
                                class="form-control"
                                id="descripcion"
                                name="descripcion"
                                placeholder="Tasa General"
                                value="{{ old('descripcion') }}"
                                class="@error('descripcion') is-invalid @enderror"
                                />
                            
                            </div>

                            <div class="mb-3">
                                <label for="exampleFormControlInput1" class="form-label">Porcentaje</label>
                                <input
                                    type="text"
                                    class="form-control"
                                    id="porcentaje"
                                    name="porcentaje"
                                    placeholder="10.5"
                                    value="{{ old('porcentaje') }}"
                                    class="@error('porcentaje') is-invalid @enderror"
                                    pattern="^\d+(\.\d{1,2})?$"
                                />
                            </div>
                           
                            <div class="form-check mt-3">
                                <input class="form-check-input" type="checkbox" value="1" id="activo" name="activo" checked />
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