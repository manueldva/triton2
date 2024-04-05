@extends('layouts.app')

  
@section('title', 'Gestionar Usuarios')

  
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
        <div class="card-body">
            <div class="demo-inline-spacing d-flex align-items-center justify-content-between">
                <h3 class="card-header">Listado</h3>    
                <a href="{{ route('users.create') }}" class="btn btn-primary">Agregar</a>
            </div>
            <div class="table-responsive text-nowrap">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Nombre Completo</th>
                            <th>Email</th>
                            <th>Empresa</th>
                            <th>Activo</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if($users->count() > 0)
                            @foreach($users as $rs)
                                <tr>
                                    <td>
                                        <i class="fab fa-angular fa-lg text-danger me-3"></i> <strong>{{ $loop->iteration }}</strong>
                                    </td>
                                    <td>{{ $rs->name }}</td>
                                    <td>{{ $rs->email }}</td>
                                    <td>{{ $rs->empresa->descripcion }}</td>
                                    <td>
                                        @if($rs->activo == 1)
                                            <span class="badge bg-label-success me-1">Activo</span>
                                        @else
                                            <span class="badge bg-label-warning me-1">Inactivo</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if(Auth::user()->root == 0 && $rs->root == 1)
                                            <span class="badge bg-label-danger me-1">X</span>
                                        @else
                                            <div class="btn-group">
                                              <button
                                                type="button"
                                                class="btn btn-outline-secondary dropdown-toggle"
                                                data-bs-toggle="dropdown"
                                                aria-expanded="false">
                                                Acción
                                              </button>
                                              <ul class="dropdown-menu">
                                                <li><a class="dropdown-item"  href="{{ route('users.edit', $rs->id)}}">Editar</a></li>
                                                <li>
                                                    <form action="{{ route('users.destroy', $rs->id) }}" method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button class="dropdown-item" type="button" data-bs-toggle="modal" data-bs-target="#confirmDeleteModal">
                                                            Eliminar
                                                        </button>
                                                    </form>
                                                </li>
                                            
                                              </ul>
                                            </div>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td class="text-center" colspan="5">Usuario no encontrado</td>
                            </tr>
                        @endif
                    </tbody>
                </table>
                @if($users->count() == 1 || $users->count() == 2)
                <br>
                <br>
                <br>
                @endif
                <br>
                {{ $users->links() }}
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