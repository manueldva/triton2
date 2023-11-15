@extends('layouts.app')
  
@section('title', 'Gestionar Categorias')
  
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
                        <input type="text" name="descripcion" class="form-control" placeholder="Buscar por descripción" value="{{ request('descripcion') }}">
                        <button type="submit" class="btn btn-primary">Buscar</button>
                    </div>
                </form>
                <a href="{{ route('categorias.create') }}" class="btn btn-primary">Agregar</a>
            </div>
            <br>

            <div class="table-responsive text-nowrap">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Descripcion</th>
                            <th>Activo</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if($categorias->count() > 0)
                            @foreach($categorias as $rs)
                                <tr>
                                    <td>
                                        <i class="fab fa-angular fa-lg text-danger me-3"></i> <strong>{{ $loop->iteration }}</strong>
                                    </td>
                                    <td>{{ $rs->descripcion }}</td>
                                    <td>
                                        @if($rs->activo == 1)
                                            <span class="badge bg-label-success me-1">Activo</span>
                                        @else
                                            <span class="badge bg-label-warning me-1">Inactivo</span>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="dropdown">
                                            <button
                                                type="button"
                                                class="btn p-0 dropdown-toggle hide-arrow"
                                                data-bs-toggle="dropdown"
                                            >
                                                <i class="bx bx-dots-vertical-rounded"></i>
                                            </button>
                                            <div class="dropdown-menu">
                                                <a class="dropdown-item" href="{{ route('categorias.edit', $rs->id)}}"><i class="bx bx-edit-alt me-1"></i> Editar</a>
                                                
                                               

                                                <form action="{{ route('categorias.destroy', $rs->id) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button class="dropdown-item" type="button" data-bs-toggle="modal" data-bs-target="#confirmDeleteModal">
                                                        <i class="bx bx-trash me-1"></i>Eliminar
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
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
                {{ $categorias->links() }}
            </div>
        </div>
    </div>

    <div class="modal fade" id="confirmDeleteModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Confirmar Eliminación</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    ¿Estás seguro de que deseas eliminar este registro?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn btn-danger" id="confirmDeleteBtn">Eliminar</button>
                </div>
            </div>
        </div>
    </div>
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