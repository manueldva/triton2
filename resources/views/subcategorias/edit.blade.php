@extends('layouts.app')
  
@section('title', 'Editar Sub Categoria')
  
@section('contents')
    <form action="{{ route('subcategorias.update', $subcategoria->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="row">
            <div class="col-md-6 mx-auto">
                <div>
                    <div class="card mb-4 mx-auto text-center">
                        <div class="demo-inline-spacing">
                            <button class="btn btn-primary">Guardar</button>
                            <a href="{{ route('subcategorias') }}" class="btn btn-secondary">Volver</a>
                           
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
                                <label for="exampleFormControlSelect1" class="form-label">Categoria</label>
                                <select class="form-select" id="categoria_id" name="categoria_id" aria-label="Default select example">
                                    @foreach($categorias as $id => $descripcion)
                                        <option value="{{ $id }}" @if ($id == $subcategoria->categoria_id) selected @endif>{{ $descripcion }}</option>
                                    @endforeach
                                </select>
                            </div>


                            <div class="mb-3">
                                <label for="exampleFormControlInput1" class="form-label">Descripción</label>
                                <input
                                type="text"
                                class="form-control"
                                id="descripcion"
                                name="descripcion"
                                placeholder="La Cocina"
                                value="{{ $subcategoria->descripcion }}"
                                class="@error('descripcion') is-invalid @enderror"
                                />
                            
                            </div>
                            
                            <div class="form-check mt-3">
                                <input class="form-check-input" type="checkbox" value="1" {{ $subcategoria->activo == 1 ? 'checked' : '' }}  id="activo" name="activo" />
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