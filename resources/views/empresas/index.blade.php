@extends('layouts.app')
  
@section('title', 'Gestionar Empresas')
  
@section('contents')
    
    @if(Session::has('success'))
    <div class="alert alert-success" role="alert">
            {{ Session::get('success') }}
        </div>
    @endif
    @if(Session::has('danger'))
    <div class="alert alert-danger" role="alert">
            {{ Session::get('danger') }}
        </div>
    @endif

    <!-- Bordered Table -->
    <div class="card">
        <h3 class="card-header">Listado</h3>   
        <div class="card-body">
            <div class="demo-inline-spacing d-flex align-items-center justify-content-between">
                 <form>
                    <div class="input-group">
                        <input type="text" name="descripcion" class="form-control" placeholder="Buscar por Descripcion" value="{{ request('descripcion') }}">
                        <button type="submit" class="btn btn-primary">Buscar</button>
                    </div>
                </form> 
                <a href="{{ route('empresas.create') }}" class="btn btn-primary">Nuevo</a>
            </div>
            <br>
            <div class="table-responsive text-nowrap">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th><center>Descripcion</center></th>
                            <th><center>Direccion</center></th>
                            <th><center>Activo</center></th>
                            <th><center>Action</center></th>
                        </tr>
                    </thead>
                    <tbody>
                        @if($empresas->count() > 0)
                            @foreach($empresas as $rs)
                                <tr>
                                    <td>
                                        <i class="fab fa-angular fa-lg text-danger me-3"></i> <strong>{{ $loop->iteration }}</strong>
                                    </td>
                                    <td><center>{{ $rs->descripcion }}</center></td>
                                    <td><center>{{ $rs->direccion }}</center></td>
                                    <td>
                                        <center>
                                        @if($rs->activo == 1)
                                            <span class="badge bg-label-success me-1">Activo</span>
                                        @else
                                            <span class="badge bg-label-warning me-1">Inactivo</span>
                                        @endif
                                        </center>
                                    </td>
                                    <td>
                                        <center>                                           
                                        @component('components.button-menu', ['menuItems' => [
                                            ['url' => route('empresas.edit', $rs->id), 'label' => 'Editar'],
                                            ['url' => route('empresas.destroy', $rs->id), 'label' => 'Eliminar'],
                                        ]])
                                        @endcomponent
                                        </center>
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td class="text-center" colspan="5">Empresa no encontrado</td>
                            </tr>
                        @endif
                    </tbody>
                </table>
                @if($empresas->count() == 1 || $empresas->count() == 2)
                <br>
                <br>
                <br>
                @endif
                <br>
                {{ $empresas->appends(['descripcion' => request('descripcion')])->links() }}
            </div>
        </div>
    </div>

    @component('components.modal-delete')
    @endcomponent
    <!--/ Bordered Table -->
@endsection

@section('js')
<script>
    // En tu archivo JavaScript
    $(document).ready(function() {
        var form;

        $('.deleteBtn').click(function() {
            // Guardar el formulario correspondiente al botón "Eliminar" que se ha hecho clic
            form = $(this).closest('.deleteForm');
        });

        $('#confirmDeleteBtn').click(function() {
            // Enviar el formulario correspondiente al hacer clic en el botón "Eliminar"
            $('#confirmDeleteModal').modal('hide'); // Cerrar el modal de confirmación
            form.submit(); // Enviar el formulario correspondiente
        });
    });
</script>
@endsection