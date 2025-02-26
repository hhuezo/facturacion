<div class="modal fade" id="modal-edit-{{ $producto->id }}" tabindex="-1" aria-labelledby="exampleModalLgLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title" id="exampleModalLgLabel">Editar Producto</h6>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{ route('producto.update', $producto->id) }}">
                    @csrf
                    @method('PUT')

                    <div class="row gy-4">
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                            <label for="barra" class="form-label">Código de Barra:</label>
                            <input type="text" class="form-control" name="barra" value="{{ $producto->barra }}">
                        </div>
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                            <label for="codigo" class="form-label">Código:</label>
                            <input type="text" class="form-control" name="codigo" value="{{ $producto->codigo }}">
                        </div>
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                            <label for="descripcion" class="form-label">Descripción:</label>
                            <input type="text" class="form-control" name="descripcion"
                                value="{{ $producto->descripcion }}" required>
                        </div>
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                            <label for="tipo_iva_id" class="form-label">Tipo de IVA:</label>
                            <select name="tipo_iva_id" class="form-select" required>
                                <option value="">SELECCIONE</option>
                                @foreach ($tipos_iva as $tipo)
                                    <option value="{{ $tipo->id }}"
                                        {{ $producto->tipo_iva_id == $tipo->id ? 'selected' : '' }}>
                                        {{ $tipo->descripcion }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                            <label for="tipo_producto_id" class="form-label">Tipo de Producto:</label>
                            <select name="tipo_producto_id" class="form-select">
                                <option value="">SELECCIONE</option>
                                @foreach ($tipos_producto as $tipo)
                                    <option value="{{ $tipo->id }}"
                                        {{ $producto->tipo_producto_id == $tipo->id ? 'selected' : '' }}>
                                        {{ $tipo->descripcion }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                            <label for="unidad_medida_id" class="form-label">Unidad de Medida:</label>
                            <select name="unidad_medida_id" class="form-select">
                                <option value="">SELECCIONE</option>
                                @foreach ($unidades_medida as $unidad)
                                    <option value="{{ $unidad->id }}"
                                        {{ $producto->unidad_medida_id == $unidad->id ? 'selected' : '' }}>
                                        {{ $unidad->descripcion }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
            </div>

            <div class="modal-footer">
                <button type="submit" class="btn btn-primary">Guardar Cambios</button>
            </div>
        </div>
        </form>
    </div>
</div>
