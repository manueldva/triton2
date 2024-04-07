@extends('layouts.app')
  
@section('title', 'Gestionar Categorias')
  
@section('contents')
    

    @component('components.categoria.categoria-modal-create')
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
                        @if($categorias->count() > 0)
                            @foreach($categorias as $rs)
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
                                        @component('components.categoria.categoria-modal-edit', ['categoria' => $rs])
                                        @endcomponent

                                        @component('components.button-menu', [
                                            'menuItems' => [
                                                ['url' => route('categorias.edit', $rs->id), 'label' => 'Editar', 'modal' => true, 'modalTarget' => '#categoriaModalEdit'.$rs->id],
                                                ['url' => route('categorias.destroy', $rs->id), 'label' => 'Eliminar'],
                                                // ... otros ítems del menú
                                            ],
                                            'categoria' => $rs // Pasar la categoría como parámetro adicional
                                        ])
                                        @endcomponent
                                        </center>
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td class="text-center" colspan="5">Categoria no encontrada</td>
                            </tr>
                        @endif
                    </tbody>
                </table>
                 @if($categorias->count() == 1 || $categorias->count() == 2)
                <br>
                <br>
                <br>
                @endif
                <br>
                {{ $categorias->appends(['descripcion' => request('descripcion')])->links() }}
            </div>

        </div>
    </div>

   
    @component('components.modal-delete')
    @endcomponent
    <!--/ Bordered Table -->

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

