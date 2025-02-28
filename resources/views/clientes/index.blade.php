@extends('layouts.app')
  
@section('title', 'Gestionar Clientes')
  
@section('contents')
    
    @component('components.modal-create', [
        'url' => route('clientes.store'),
        'descripcion' => 'Cliente',
        'extraCampos' => [
            ['label' => 'Nombre', 'name' => 'nombre', 'type' => 'text', 'placeholder' => 'Ingrese un nombre', 'required' => true],
            ['label' => 'Tipo de Contacto', 'name' => 'tipocontacto_id', 'type' => 'select', 'options' => $tipocontactos, 'required' => true],
            ['label' => 'Contacto', 'name' => 'contacto', 'type' => 'text', 'placeholder' => 'Ingrese un contacto', 'required' => true]
        ],
        'mostrarDescripcion' => false
    ])
    @endcomponent
    
    
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
                        <input type="text" name="nombre" class="form-control" placeholder="Buscar por nombre" value="{{ request('nombre') }}">
                        <button type="submit" class="btn btn-primary">Buscar</button>
                    </div>
                </form>
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#ModalCreate">
                    Nuevo
                </button>

            </div>
            <br>

            <div class="table-responsive text-nowrap">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th><center>#</center></th>
                            <th><center>Nombre</center></th>
                            <th><center>Activo</center></th>
                            <th><center>Action</center></th>
                        </tr>
                    </thead>
                    <tbody>
                        @if($clientes->count() > 0)
                            @foreach($clientes as $rs)
                                <tr>
                                    <td>
                                        <center>
                                        <i class="fab fa-angular fa-lg text-danger me-3"></i> <strong>{{ $loop->iteration }}</strong>
                                        </center>
                                    </td>
                                    <td><center>{{ $rs->nombre }}</center></td>
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
                                        <!-- Aquí incluirías el componente del modal de edición -->
                                        @component('components.modal-edit', ['url' => route('clientes.edit', $rs->id), 'rs' => $rs, 'descripcion' => 'Cliente'])
                                        @endcomponent

                                        @component('components.button-menu', [
                                            'menuItems' => [
                                                ['url' => route('clientes.edit', $rs->id), 'label' => 'Editar', 'modal' => true, 'modalTarget' => '#modalEdit'.$rs->id],
                                                ['url' => route('clientes.destroy', $rs->id), 'label' => 'Eliminar'],
                                                // ... otros ítems del menú
                                            ],
                                            'rs' => $rs // Pasar la categoría como parámetro adicional
                                        ])
                                        @endcomponent
                                        </center>
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td class="text-center" colspan="5">Cliente no encontrada</td>
                            </tr>
                        @endif
                    </tbody>
                </table>
                 @if($clientes->count() == 1 || $clientes->count() == 2)
                <br>
                <br>
                <br>
                @endif
                <br>
                {{ $clientes->appends(['nombre' => request('nombre')])->links() }}
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

