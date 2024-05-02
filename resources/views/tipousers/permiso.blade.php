@extends('layouts.app')

@section('title', 'Gestionar Permisos')
  
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
                        <h5 class="card-header"><center>Modulos</center></h5>
                        <div class="card-body">
                            @foreach($modules as $id => $descripcion)
                            <div class="di">
                                <label class="form-check-label" for="defaultRadio1"> {{ $descripcion }} : </label>
                                &nbsp; &nbsp; 
                                <input
                                name="default-radio-1"
                                class="form-check-input"
                                type="radio"
                                value=""
                                id="defaultRadio1"
                                />
                                <label class="form-check-label" for="defaultRadio1"> SI </label>
                                &nbsp; &nbsp; 
                          
                                <input
                                name="default-radio-1"
                                class="form-check-input"
                                type="radio"
                                value=""
                                id="defaultRadio2"
                                checked
                                />
                                <label class="form-check-label" for="defaultRadio2"> NO </label>
                            
                            </div>
                            
                            @endforeach

                           
                            <br>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
    </form>
@endsection

@section('js')
<script>
    $(document).ready(function() {
        $('#confirmDeleteBtn').click(function() {
            // Enviar el formulario al hacer clic en el botón "Eliminar"
            $('#confirmDeleteModal').modal('hide'); // Cerrar el modal de confirmación
            $('form').submit(); // Enviar el formulario
        });
    });
</script>
@endsection