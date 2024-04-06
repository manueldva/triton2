<div class="modal fade" id="categoriaModalEdit{{ $categoria->id }}" tabindex="-1" aria-labelledby="categoriaModalEditLabel{{ $categoria->id }}" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="categoriaModalLabel">Editar Categoría</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
             <form action="{{ route('categorias.update', $categoria->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <!-- Campos del formulario -->
                    <div class="mb-3 text-start">
                        <label for="descripcion" class="form-label">Descripción</label>
                        <input type="text" class="form-control" id="descripcion" name="descripcion" value="{{ $categoria->descripcion }}">
                    </div>
                    <div class="form-check text-start">
                        <input class="form-check-input" type="checkbox" value="1" id="activo" name="activo"  {{ $categoria->activo ? 'checked' : '' }}>
                        <label class="form-check-label" for="activo">Activo</label>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Actualizar</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                </div>
            </form>
        </div>
    </div>
</div>