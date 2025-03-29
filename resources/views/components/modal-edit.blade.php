<div class="modal fade" id="modalEdit{{ $rs->id }}" tabindex="-1" aria-labelledby="modalEditLabel{{ $rs->id }}" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalLabel">Editar {{ $descripcion }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ $url }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <!-- Campos del formulario -->
                    @if(!isset($mostrarDescripcion) || $mostrarDescripcion !== false)
                        <div class="mb-3 text-start">
                            <label for="descripcion" class="form-label">Descripción</label>
                            <input type="text" class="form-control" id="descripcion" name="descripcion" value="{{ $rs->descripcion }}" required maxlength="250">
                        </div>
                    @endif
                     <!-- Campos adicionales dinámicos -->
                     @if(isset($extraCampos))
                        @foreach ($extraCampos as $campo)
                            @if($campo['type'] === 'select' && isset($campo['options']))
                                <div class="mb-3 text-start">
                                    <select class="form-select" id="{{ $campo['name'] }}" name="{{ $campo['name'] }}">
                                        <option value="">Seleccione una opción</option>
                                        @foreach($campo['options'] as $id => $descripcion)
                                            <option value="{{ $id }}" {{ $campo['value'] == $id ? 'selected' : '' }}>
                                                {{ $descripcion }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            @else
                                <div class="mb-3 text-start">
                                    <label for="{{ $campo['name'] }}" class="form-label">{{ $campo['label'] }}</label>
                                    <input type="{{ $campo['type'] }}" class="form-control" id="{{ $campo['name'] }}" name="{{ $campo['name'] }}" placeholder="{{ $campo['placeholder'] ?? '' }}" value="{{ $campo['value'] ?? '' }}" {{ $campo['required'] ? 'required' : '' }}>
                                </div>
                            @endif
                        @endforeach
                    @endif
                    <div class="form-check text-start">
                        <input class="form-check-input" type="checkbox" value="1" id="activo" name="activo" {{ $rs->activo ? 'checked' : '' }}>
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
