@extends('layouts.app')

@section('title', 'Gestionar Permisos')
  
@section('contents')
     <form action="{{ route('tipousers.permisoupdate', $tipouser->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="row">
            <div class="col-md-6 mx-auto">
                <div>
                    <div class="card mb-4 mx-auto text-center">
                        <div class="demo-inline-spacing">
                            <button class="btn btn-primary">Guardar</button>
                            <a href="{{ route('tipousers') }}" class="btn btn-secondary">Volver</a>
                           
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
                        <div class="card-body row">
                            @foreach($modules as $id => $descripcion)
	                            <div class="form-check flex justify-content-center">
	                                <input class="form-check-input" type="checkbox" value="{{$id}}" id="{{$id}}" name="modulos[]" @if (in_array($id, $permisos)) checked @endif />
	                                &nbsp;
	                                <label class="form-check-label" for="{{$id}}"> <h6>{{ $descripcion }}</h6></label>  
	                            </div>
	                            
                            @endforeach
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