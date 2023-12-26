@extends('layouts.app')
  
@section('title', 'Editar T. Producto')
  
@section('contents')
    <form action="{{ route('tipoproductos.update', $tipoproducto->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="row">
            <div class="col-md-6 mx-auto">
                <div>
                    <div class="card mb-4 mx-auto text-center">
                        <div class="demo-inline-spacing">
                            <button class="btn btn-primary">Guardar</button>
                            <a href="{{ route('tipoproductos.create') }}" class="btn btn-info">Nuevo</a>
                            <a href="{{ route('tipoproductos') }}" class="btn btn-secondary">Volver</a>
                           
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
                                value="{{ $tipoproducto->descripcion }}"
                                class="@error('descripcion') is-invalid @enderror"
                                />
                            
                            </div>
                            
                            <div class="form-check mt-3">
                                <input class="form-check-input" type="checkbox" value="1" {{ $tipoproducto->activo == 1 ? 'checked' : '' }}  id="activo" name="activo" />
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