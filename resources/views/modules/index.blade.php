@extends('layouts.app')
  
@section('title', 'Gestionar Modulos')
  
@section('contents')
    
    @component('components.modal-create',['url' => route('modules.store'), 'descripcion' => 'Modulo' ])
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
                        <input type="text" name="descripcion" class="form-control" placeholder="Buscar por descripción" value="{{ request('descripcion') }}">
                        <button type="submit" class="btn btn-primary">Buscar</button>
                    </div>
                </form>
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#categoriaModalCreate">
                    Nuevo
                </button>

            </div>
            <br>

            <div class="table-responsive text-nowrap">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th><center>#</center></th>
                            <th><center>Descripcion</center></th>
                            <th><center>Activo</center></th>
                            <th><center>Action</center></th>
                        </tr>
                    </thead>
                    <tbody>
                        @if($modules->count() > 0)
                            @foreach($modules as $rs)
                                <tr>
                                    <td>
                                        <center>
                                        <i class="fab fa-angular fa-lg text-danger me-3"></i> <strong>{{ $loop->iteration }}</strong>
                                        </center>
                                    </td>
                                    <td><center>{{ $rs->descripcion }}</center></td>
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
                                        @component('components.modal-edit', ['url' => route('modules.edit', $rs->id), 'rs' => $rs, 'descripcion' => 'Modulo'])
                                        @endcomponent

                                        @component('components.button-menu', [
                                            'menuItems' => [
                                                ['url' => route('modules.edit', $rs->id), 'label' => 'Editar', 'modal' => true, 'modalTarget' => '#modalEdit'.$rs->id],
                                                ['url' => route('modules.destroy', $rs->id), 'label' => 'Eliminar'],
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
                                <td class="text-center" colspan="5">Tipo usuario no encontrado</td>
                            </tr>
                        @endif
                    </tbody>
                </table>
                 @if($modules->count() == 1 || $modules->count() == 2)
                <br>
                <br>
                <br>
                @endif
                <br>
                {{ $modules->appends(['descripcion' => request('descripcion')])->links() }}
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

